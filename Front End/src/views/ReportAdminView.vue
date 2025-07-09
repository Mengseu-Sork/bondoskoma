<template>
<admin-aside>
        <div class="mx-auto my-8 px-4 sm:px-6 lg:px-12 max-w-screen-xl">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Our Reports</h1>
      <button
        @click="openCreateModal"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New Report
      </button>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
      <!-- Sticky Search and Year Select Form -->
      <div class="sticky top-0 z-10 bg-white pb-4 border-b border-gray-200 mb-4">
        <div class="flex flex-col sm:flex-row gap-4">
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search reports by title or description..."
              class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 hover:bg-white"
              aria-label="Search reports"
            />
            <button
              v-if="searchQuery"
              @click="clearSearch"
              class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
              aria-label="Clear search"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="relative">
            <select
              v-model="selectedYear"
              class="w-full sm:w-40 pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 hover:bg-white"
              aria-label="Filter by year"
            >
              <option value="">All Years</option>
              <option v-for="year in availableYears" :key="year" :value="year.toString()">{{ year }}</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="text-gray-600 text-center py-8">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
        Loading reports...
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="text-red-600 text-center py-4 bg-red-50 rounded-lg">
        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Failed to load reports: {{ error }}
      </div>

      <!-- Reports Content -->
      <div v-else-if="filteredReports && filteredReports.length > 0">
        <!-- Desktop Table View -->
        <div class="hidden lg:block">
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
              <thead class="bg-gray-50">
                <tr>
                  <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                    Title
                  </th>
                  <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                    Year
                  </th>
                  <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                    Description
                  </th>
                  <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                    File
                  </th>
                  <th class="py-4 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr
                  v-for="report in filteredReports"
                  :key="report.id"
                  class="hover:bg-gray-50 transition-colors"
                >
                  <!-- Title Column -->
                  <td class="py-4 px-6 border-b">
                    <div class="max-w-xs">
                      <div v-if="report.title && report.title.length <= 50" class="text-sm font-medium text-gray-900">
                        {{ report.title }}
                      </div>
                      <div v-else-if="report.title">
                        <div class="text-sm font-medium text-gray-900">
                          <span v-if="!expandedTitles[report.id]">
                            {{ report.title.substring(0, 50) }}...
                          </span>
                          <span v-else>{{ report.title }}</span>
                        </div>
                        <button
                          @click="toggleTitle(report.id)"
                          class="text-xs text-blue-600 hover:text-blue-800 mt-1 font-medium"
                        >
                          {{ expandedTitles[report.id] ? 'Show less' : 'See more' }}
                        </button>
                      </div>
                    </div>
                  </td>

                  <!-- Year Column -->
                  <td class="py-4 px-6 border-b">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                      {{ report.year }}
                    </span>
                  </td>

                  <!-- Description Column -->
                  <td class="py-4 px-6 border-b">
                    <div class="max-w-sm">
                      <div v-if="report.description && report.description.length <= 100" class="text-sm text-gray-600">
                        {{ report.description }}
                      </div>
                      <div v-else-if="report.description">
                        <div class="text-sm text-gray-600">
                          <span v-if="!expandedDescriptions[report.id]">
                            {{ report.description.substring(0, 100) }}...
                          </span>
                          <span v-else>{{ report.description }}</span>
                        </div>
                        <button
                          @click="toggleDescription(report.id)"
                          class="text-xs text-blue-600 hover:text-blue-800 mt-1 font-medium"
                        >
                          {{ expandedDescriptions[report.id] ? 'Show less' : 'See more' }}
                        </button>
                      </div>
                    </div>
                  </td>

                  <!-- File Column -->
                  <td class="py-4 px-6 border-b">
                    <span v-if="report.file_url" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>
                      Attached
                    </span>
                    <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                      No file
                    </span>
                  </td>

                  <!-- Actions Column -->
                  <td class="py-4 px-6 border-b">
                    <div class="flex gap-2">
                      <button
                        @click="editReport(report)"
                        class="px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition text-xs font-medium"
                        aria-label="Edit report"
                      >
                        Edit
                      </button>
                      <button
                        @click="deleteReport(report)"
                        class="px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-xs font-medium"
                        aria-label="Delete report"
                      >
                        Delete
                      </button>
                      <a
                        v-if="report.file_url"
                        :href="report.file_url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="px-3 py-1.5 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-xs font-medium inline-block"
                        aria-label="Download report"
                      >
                        Download
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Mobile Card View -->
        <div class="block lg:hidden space-y-4">
          <div
            v-for="report in filteredReports"
            :key="report.id"
            class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow"
          >
            <!-- Header with Title and Year -->
            <div class="flex justify-between items-start mb-3">
              <div class="flex-1 mr-3">
                <div v-if="report.title && report.title.length <= 40" class="text-lg font-semibold text-gray-900">
                  {{ report.title }}
                </div>
                <div v-else-if="report.title">
                  <div class="text-lg font-semibold text-gray-900">
                    <span v-if="!expandedTitles[report.id]">
                      {{ report.title.substring(0, 40) }}...
                    </span>
                    <span v-else>{{ report.title }}</span>
                  </div>
                  <button
                    @click="toggleTitle(report.id)"
                    class="text-sm text-blue-600 hover:text-blue-800 mt-1 font-medium"
                  >
                    {{ expandedTitles[report.id] ? 'Show less' : 'See more' }}
                  </button>
                </div>
              </div>
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 flex-shrink-0">
                {{ report.year }}
              </span>
            </div>

            <!-- Description -->
            <div class="mb-3">
              <div v-if="report.description && report.description.length <= 80" class="text-sm text-gray-600">
                {{ report.description }}
              </div>
              <div v-else-if="report.description">
                <div class="text-sm text-gray-600">
                  <span v-if="!expandedDescriptions[report.id]">
                    {{ report.description.substring(0, 80) }}...
                  </span>
                  <span v-else>{{ report.description }}</span>
                </div>
                <button
                  @click="toggleDescription(report.id)"
                  class="text-sm text-blue-600 hover:text-blue-800 mt-1 font-medium"
                >
                  {{ expandedDescriptions[report.id] ? 'Show less' : 'See more' }}
                </button>
              </div>
            </div>

            <!-- File Status -->
            <div class="mb-4">
              <span v-if="report.file_url" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                File Attached
              </span>
              <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                No file
              </span>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-2">
              <button
                @click="editReport(report)"
                class="flex-1 min-w-0 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium text-center"
                aria-label="Edit report"
              >
                Edit
              </button>
              <button
                @click="deleteReport(report)"
                class="flex-1 min-w-0 px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium text-center"
                aria-label="Delete report"
              >
                Delete
              </button>
              <a
                v-if="report.file_url"
                :href="report.file_url"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-1 min-w-0 px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium text-center inline-block"
                aria-label="Download report"
              >
                Download
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No reports found</h3>
        <p class="text-gray-600 mb-4">
          {{ searchQuery || selectedYear ? 'Try adjusting your search criteria' : 'Get started by creating your first report' }}
        </p>
        <button
          v-if="!searchQuery && !selectedYear"
          @click="openCreateModal"
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
        >
          Create Your First Report
        </button>
      </div>
    </div>

    <!-- Create/Edit Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
              {{ isEditing ? 'Edit Report' : 'Create New Report' }}
            </h2>
            <button
              @click="closeModal"
              class="text-gray-400 hover:text-gray-600 transition"
              aria-label="Close modal"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Title Field -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Title <span class="text-red-500">*</span>
              </label>
              <input
                id="title"
                v-model="formData.title"
                type="text"
                required
                maxlength="255"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': formErrors.title }"
                placeholder="Enter report title"
              />
              <p v-if="formErrors.title" class="mt-1 text-sm text-red-600">{{ formErrors.title }}</p>
            </div>
            <!-- Year Field -->
            <div>
              <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                Year <span class="text-red-500">*</span>
              </label>
              <input
                id="year"
                v-model.number="formData.year"
                type="number"
                required
                :min="1900"
                :max="currentYear"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': formErrors.year }"
                placeholder="Enter year"
              />
              <p v-if="formErrors.year" class="mt-1 text-sm text-red-600">{{ formErrors.year }}</p>
            </div>
            <!-- Description Field -->
            <div>
              <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Description <span class="text-red-500">*</span>
              </label>
              <textarea
                id="description"
                v-model="formData.description"
                required
                rows="4"
                maxlength="1000"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-vertical"
                :class="{ 'border-red-500': formErrors.description }"
                placeholder="Enter report description"
              ></textarea>
              <div class="flex justify-between mt-1">
                <p v-if="formErrors.description" class="text-sm text-red-600">{{ formErrors.description }}</p>
                <p class="text-sm text-gray-500">{{ formData.description.length }}/1000</p>
              </div>
            </div>
            <!-- File Upload Field -->
            <div>
              <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                File Upload
              </label>
              <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition">
                <input
                  id="file"
                  ref="fileInput"
                  type="file"
                  accept=".pdf,.doc,.docx"
                  @change="handleFileChange"
                  class="hidden"
                />
                                
                <div v-if="!selectedFile && !currentFileUrl">
                  <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                  <p class="text-gray-600 mb-2">Click to upload or drag and drop</p>
                  <p class="text-sm text-gray-500">PDF, DOC, DOCX up to 2MB</p>
                  <button
                    type="button"
                    @click="$refs.fileInput.click()"
                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                  >
                    Choose File
                  </button>
                </div>
                <div v-else-if="selectedFile" class="flex items-center justify-between bg-gray-50 p-3 rounded">
                  <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <div>
                      <p class="font-medium text-gray-900">{{ selectedFile.name }}</p>
                      <p class="text-sm text-gray-500">{{ formatFileSize(selectedFile.size) }}</p>
                    </div>
                  </div>
                  <button
                    type="button"
                    @click="removeFile"
                    class="text-red-500 hover:text-red-700 transition"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
                <div v-else-if="currentFileUrl" class="text-left">
                  <p class="text-sm text-gray-600 mb-2">Current file:</p>
                  <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                    <div class="flex items-center gap-3">
                      <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>
                      <div>
                        <p class="font-medium text-gray-900">{{ getFileName(currentFileUrl) }}</p>
                        <a :href="currentFileUrl" target="_blank" class="text-sm text-blue-600 hover:underline">
                          View current file
                        </a>
                      </div>
                    </div>
                  </div>
                  <button
                    type="button"
                    @click="$refs.fileInput.click()"
                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                  >
                    Replace File
                  </button>
                </div>
              </div>
              <p v-if="formErrors.file" class="mt-1 text-sm text-red-600">{{ formErrors.file }}</p>
            </div>
            <!-- Form Actions -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                :disabled="submitting"
                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span v-if="submitting" class="flex items-center justify-center">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  {{ isEditing ? 'Updating...' : 'Creating...' }}
                </span>
                <span v-else>
                  {{ isEditing ? 'Update Report' : 'Create Report' }}
                </span>
              </button>
              <button
                type="button"
                @click="closeModal"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition"
              >
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
              <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
              </svg>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-medium text-gray-900">Delete Report</h3>
              <p class="text-sm text-gray-500">This action cannot be undone.</p>
            </div>
          </div>
          <div class="mb-6">
            <p class="text-gray-700">
              Are you sure you want to delete the report 
              <span class="font-semibold">"{{ reportToDelete?.title }}"</span>?
            </p>
            <p class="text-sm text-gray-500 mt-2">
              This will permanently remove the report and any associated files.
            </p>
          </div>
          <div class="flex gap-3">
            <button
              @click="confirmDelete"
              :disabled="deleting"
              class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium disabled:opacity-50"
            >
              {{ deleting ? 'Deleting...' : 'Delete Report' }}
            </button>
            <button
              @click="cancelDelete"
              class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</admin-aside>
</template>

<script setup>
import { ref, computed, onMounted, reactive } from "vue";
import api from "@/plugin/axios";
import AdminAside from "@/components/AdminAside.vue";

const reports = ref([]);
const searchQuery = ref("");
const selectedYear = ref("");
const loading = ref(false);
const error = ref(null);
const showModal = ref(false);
const showDeleteModal = ref(false);
const isEditing = ref(false);
const editingReport = ref(null);
const reportToDelete = ref(null);
const submitting = ref(false);
const deleting = ref(false);
const selectedFile = ref(null);
const currentFileUrl = ref(null);
const currentYear = new Date().getFullYear();

// For expandable text
const expandedTitles = ref({});
const expandedDescriptions = ref({});

const formData = reactive({
  title: '',
  year: currentYear,
  description: ''
});

const formErrors = reactive({});

onMounted(async () => {
  await fetchReports();
});

const fetchReports = async () => {
  loading.value = true;
  error.value = null;
  try {
    const res = await api.get("/reports");
    reports.value = res.data.data.map(report => ({
      ...report,
      year: Number(report.year),
    }));
  } catch (err) {
    error.value = err.response?.data?.message || err.message || "An error occurred while fetching reports.";
  } finally {
    loading.value = false;
  }
};

const availableYears = computed(() => {
  if (!reports.value || reports.value.length === 0) return [];
  return [...new Set(reports.value.map(report => report.year))].sort((a, b) => b - a);
});

const filteredReports = computed(() => {
  if (!reports.value || reports.value.length === 0) return [];
  
  let filtered = [...reports.value];
  
  if (searchQuery.value) {
    filtered = filtered.filter(
      (report) =>
        (report.title && report.title.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (report.description && report.description.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
  }
  
  if (selectedYear.value) {
    filtered = filtered.filter((report) => String(report.year) === selectedYear.value);
  }
  
  return filtered;
});

const toggleTitle = (reportId) => {
  expandedTitles.value[reportId] = !expandedTitles.value[reportId];
};

const toggleDescription = (reportId) => {
  expandedDescriptions.value[reportId] = !expandedDescriptions.value[reportId];
};

const clearSearch = () => {
  searchQuery.value = "";
};

const openCreateModal = () => {
  isEditing.value = false;
  editingReport.value = null;
  currentFileUrl.value = null;
  resetForm();
  showModal.value = true;
};

const editReport = (report) => {
  isEditing.value = true;
  editingReport.value = report;
  currentFileUrl.value = report.file_url;
  
  // Fill form with existing data
  formData.title = report.title;
  formData.year = report.year;
  formData.description = report.description;
  
  clearFormErrors();
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  resetForm();
  clearFormErrors();
  selectedFile.value = null;
  currentFileUrl.value = null;
};

const resetForm = () => {
  formData.title = '';
  formData.year = currentYear;
  formData.description = '';
};

const clearFormErrors = () => {
  Object.keys(formErrors).forEach(key => delete formErrors[key]);
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (!file) return;

  // Clear previous errors
  delete formErrors.file;

  // Validate file type
  const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
  if (!allowedTypes.includes(file.type)) {
    formErrors.file = 'Please select a PDF, DOC, or DOCX file.';
    event.target.value = '';
    return;
  }

  // Validate file size (2MB)
  if (file.size > 2 * 1024 * 1024) {
    formErrors.file = 'File size must be less than 2MB.';
    event.target.value = '';
    return;
  }

  selectedFile.value = file;
};

const removeFile = () => {
  selectedFile.value = null;
  if (document.getElementById('file')) {
    document.getElementById('file').value = '';
  }
};

const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes';
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

const getFileName = (url) => {
  return url.split('/').pop() || 'Document';
};

const validateForm = () => {
  clearFormErrors();
  let isValid = true;

  if (!formData.title.trim()) {
    formErrors.title = 'Title is required.';
    isValid = false;
  } else if (formData.title.length > 255) {
    formErrors.title = 'Title must be less than 255 characters.';
    isValid = false;
  }

  if (!formData.year) {
    formErrors.year = 'Year is required.';
    isValid = false;
  } else if (formData.year < 1900 || formData.year > currentYear) {
    formErrors.year = `Year must be between 1900 and ${currentYear}.`;
    isValid = false;
  }

  if (!formData.description.trim()) {
    formErrors.description = 'Description is required.';
    isValid = false;
  } else if (formData.description.length > 1000) {
    formErrors.description = 'Description must be less than 1000 characters.';
    isValid = false;
  }

  return isValid;
};

const handleSubmit = async () => {
  if (!validateForm()) {
    return;
  }

  submitting.value = true;
  try {
    const formDataToSend = new FormData();
    formDataToSend.append('title', formData.title.trim());
    formDataToSend.append('year', formData.year.toString());
    formDataToSend.append('description', formData.description.trim());

    if (selectedFile.value) {
      formDataToSend.append('file', selectedFile.value);
    }

    if (isEditing.value) {
      // Update existing report
      formDataToSend.append('_method', 'PUT');
      const response = await api.post(`/reports/${editingReport.value.id}`, formDataToSend, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      // Update the report in the local array
      const index = reports.value.findIndex(r => r.id === editingReport.value.id);
      if (index !== -1) {
        reports.value[index] = {
          ...response.data.data,
          year: Number(response.data.data.year),
        };
      }
    } else {
      // Create new report
      const response = await api.post('/reports', formDataToSend, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      // Add the new report to the local array
      reports.value.unshift({
        ...response.data.data,
        year: Number(response.data.data.year),
      });
    }

    closeModal();
  } catch (err) {
    if (err.response?.data?.errors) {
      // Handle Laravel validation errors
      Object.assign(formErrors, err.response.data.errors);
    } else {
      error.value = err.response?.data?.message || err.message || 'Failed to save report';
    }
  } finally {
    submitting.value = false;
  }
};

const deleteReport = (report) => {
  reportToDelete.value = report;
  showDeleteModal.value = true;
};

const confirmDelete = async () => {
  deleting.value = true;
  try {
    await api.delete(`/reports/${reportToDelete.value.id}`);
    const index = reports.value.findIndex(r => r.id === reportToDelete.value.id);
    if (index !== -1) {
      reports.value.splice(index, 1);
    }
    cancelDelete();
  } catch (err) {
    error.value = err.response?.data?.message || err.message || "Failed to delete report.";
    cancelDelete();
  } finally {
    deleting.value = false;
  }
};

const cancelDelete = () => {
  showDeleteModal.value = false;
  reportToDelete.value = null;
};
</script>

<style scoped>
/* Custom scrollbar for webkit browsers */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}

/* Smooth transitions */
* {
  transition: all 0.2s ease-in-out;
}

/* Focus styles */
button:focus,
input:focus,
textarea:focus,
select:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Hover effects */
.hover\:shadow-md:hover {
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Mobile optimizations */
@media (max-width: 640px) {
  .max-w-screen-xl {
    padding-left: 1rem;
    padding-right: 1rem;
  }
}
</style>