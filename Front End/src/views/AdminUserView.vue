<template>
  <AdminLayout>
    <div class="h-full">
      <!-- Page Header -->
      <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex justify-between items-center">
          <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">User Management</h2>
            <p class="text-gray-600">Manage system users and their permissions</p>
          </div>
          
          <button 
            @click="showAddModal = true"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Add User</span>
          </button>
        </div>
      </div>

      <!-- Filters and Search -->
      <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <!-- Search Bar -->
          <div class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search users by name or email..."
              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
          </div>

          <!-- Filters -->
          <div class="flex gap-3">
            <select 
              v-model="selectedRole"
              class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
              <option value="">All Roles</option>
              <option value="admin">Admin</option>
              <option value="editor">Editor</option>
              <option value="viewer">Viewer</option>
            </select>

            <select 
              v-model="selectedStatus"
              class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
              <option value="">All Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Users Table -->
      <div class="flex-1 overflow-auto">
        <div class="bg-white">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 sticky top-0">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <input 
                    type="checkbox" 
                    v-model="selectAll"
                    @change="toggleSelectAll"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                  />
                </th>
                <th 
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                  @click="sortBy('name')"
                >
                  <div class="flex items-center space-x-1">
                    <span>User</span>
                    <svg v-if="sortField === 'name'" :class="['w-4 h-4', sortDirection === 'asc' ? 'transform rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </th>
                <th 
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                  @click="sortBy('role')"
                >
                  <div class="flex items-center space-x-1">
                    <span>Role</span>
                    <svg v-if="sortField === 'role'" :class="['w-4 h-4', sortDirection === 'asc' ? 'transform rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </th>
                <th 
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                  @click="sortBy('status')"
                >
                  <div class="flex items-center space-x-1">
                    <span>Status</span>
                    <svg v-if="sortField === 'status'" :class="['w-4 h-4', sortDirection === 'asc' ? 'transform rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </th>
                <th 
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                  @click="sortBy('lastLogin')"
                >
                  <div class="flex items-center space-x-1">
                    <span>Last Login</span>
                    <svg v-if="sortField === 'lastLogin'" :class="['w-4 h-4', sortDirection === 'asc' ? 'transform rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr 
                v-for="user in paginatedUsers" 
                :key="user.id"
                :class="[
                  'hover:bg-gray-50 transition-colors duration-200',
                  selectedUsers.includes(user.id) ? 'bg-blue-50' : ''
                ]"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <input 
                    type="checkbox" 
                    :value="user.id"
                    v-model="selectedUsers"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                  />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-sm font-medium text-white">
                          {{ user.name.split(' ').map(n => n[0]).join('').toUpperCase() }}
                        </span>
                      </div>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                      <div class="text-sm text-gray-500">{{ user.email }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                    user.role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                    user.role === 'editor' ? 'bg-blue-100 text-blue-800' : 
                    'bg-gray-100 text-gray-800'
                  ]">
                    {{ user.role.charAt(0).toUpperCase() + user.role.slice(1) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                    user.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                  ]">
                    <span :class="[
                      'w-1.5 h-1.5 mr-1.5 rounded-full',
                      user.status === 'active' ? 'bg-green-400' : 'bg-red-400'
                    ]"></span>
                    {{ user.status.charAt(0).toUpperCase() + user.status.slice(1) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ user.lastLogin }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex items-center space-x-2">
                    <button 
                      @click="editUser(user)"
                      class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                      title="Edit User"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </button>
                    <button 
                      @click="toggleUserStatus(user)"
                      :class="[
                        'transition-colors duration-200',
                        user.status === 'active' ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900'
                      ]"
                      :title="user.status === 'active' ? 'Deactivate User' : 'Activate User'"
                    >
                      <svg v-if="user.status === 'active'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                      </svg>
                      <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </button>
                    <button 
                      @click="deleteUser(user.id)"
                      class="text-red-600 hover:text-red-900 transition-colors duration-200"
                      title="Delete User"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Empty State -->
          <div v-if="filteredUsers.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="bg-white border-t border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-700">
              Showing {{ ((currentPage - 1) * itemsPerPage) + 1 }} to {{ Math.min(currentPage * itemsPerPage, filteredUsers.length) }} of {{ filteredUsers.length }} results
            </span>
            <select 
              v-model="itemsPerPage"
              class="ml-2 px-2 py-1 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
              <option :value="10">10 per page</option>
              <option :value="25">25 per page</option>
              <option :value="50">50 per page</option>
              <option :value="100">100 per page</option>
            </select>
          </div>

          <div class="flex items-center space-x-2">
            <button 
              @click="currentPage = Math.max(1, currentPage - 1)"
              :disabled="currentPage === 1"
              :class="[
                'px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200',
                currentPage === 1 
                  ? 'text-gray-400 cursor-not-allowed' 
                  : 'text-gray-700 hover:bg-gray-50'
              ]"
            >
              Previous
            </button>

            <div class="flex space-x-1">
              <button
                v-for="page in visiblePages"
                :key="page"
                @click="currentPage = page"
                :class="[
                  'px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200',
                  currentPage === page
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-700 hover:bg-gray-50'
                ]"
              >
                {{ page }}
              </button>
            </div>

            <button 
              @click="currentPage = Math.min(totalPages, currentPage + 1)"
              :disabled="currentPage === totalPages"
              :class="[
                'px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200',
                currentPage === totalPages 
                  ? 'text-gray-400 cursor-not-allowed' 
                  : 'text-gray-700 hover:bg-gray-50'
              ]"
            >
              Next
            </button>
          </div>
        </div>
      </div>

      <!-- Bulk Actions Bar -->
      <div 
        v-if="selectedUsers.length > 0"
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-white border border-gray-200 rounded-lg shadow-lg px-6 py-3 flex items-center space-x-4 z-50"
      >
        <span class="text-sm font-medium text-gray-700">
          {{ selectedUsers.length }} user{{ selectedUsers.length > 1 ? 's' : '' }} selected
        </span>
        <div class="flex space-x-2">
          <button 
            @click="bulkActivate"
            class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-200"
          >
            Activate
          </button>
          <button 
            @click="bulkDeactivate"
            class="px-3 py-1 text-sm bg-yellow-600 text-white rounded hover:bg-yellow-700 transition-colors duration-200"
          >
            Deactivate
          </button>
          <button 
            @click="bulkDelete"
            class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition-colors duration-200"
          >
            Delete
          </button>
          <button 
            @click="clearSelection"
            class="px-3 py-1 text-sm bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors duration-200"
          >
            Clear
          </button>
        </div>
      </div>

      <!-- Add User Modal -->
      <div v-if="showAddModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full max-h-[90vh] overflow-y-auto">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900">Add New User</h3>
            <button 
              @click="showAddModal = false"
              class="text-gray-400 hover:text-gray-600 transition-colors duration-200"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
              <input
                v-model="newUser.name"
                type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter full name"
              />
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
              <input
                v-model="newUser.email"
                type="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter email address"
              />
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
              <select 
                v-model="newUser.role"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="viewer">Viewer</option>
                <option value="editor">Editor</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
              <select 
                v-model="newUser.status"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
          
          <div class="flex space-x-3 mt-6">
            <button
              @click="showAddModal = false"
              class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors duration-200"
            >
              Cancel
            </button>
            <button
              @click="addUser"
              :disabled="!newUser.name || !newUser.email"
              :class="[
                'flex-1 px-4 py-2 text-sm font-medium text-white border border-transparent rounded-lg transition-colors duration-200',
                newUser.name && newUser.email
                  ? 'bg-blue-600 hover:bg-blue-700'
                  : 'bg-gray-400 cursor-not-allowed'
              ]"
            >
              Add User
            </button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import AdminLayout from '../components/AdminAside.vue'

// Reactive state
const searchQuery = ref('')
const selectedRole = ref('')
const selectedStatus = ref('')
const showAddModal = ref(false)
const selectedUsers = ref([])
const selectAll = ref(false)
const currentPage = ref(1)
const itemsPerPage = ref(25)
const sortField = ref('name')
const sortDirection = ref('asc')

// New user form
const newUser = ref({
  name: '',
  email: '',
  role: 'viewer',
  status: 'active'
})

// Sample users data
const users = ref([
  {
    id: 1,
    name: 'John Doe',
    email: 'john@bandoskomar.org',
    role: 'admin',
    status: 'active',
    lastLogin: '2 hours ago',
    createdAt: '2024-01-15'
  },
  {
    id: 2,
    name: 'Jane Smith',
    email: 'jane@bandoskomar.org',
    role: 'editor',
    status: 'active',
    lastLogin: '1 day ago',
    createdAt: '2024-01-10'
  },
  {
    id: 3,
    name: 'Mike Johnson',
    email: 'mike@bandoskomar.org',
    role: 'viewer',
    status: 'inactive',
    lastLogin: '1 week ago',
    createdAt: '2024-01-05'
  },
  {
    id: 4,
    name: 'Sarah Wilson',
    email: 'sarah@bandoskomar.org',
    role: 'editor',
    status: 'active',
    lastLogin: '3 hours ago',
    createdAt: '2024-01-20'
  },
  {
    id: 5,
    name: 'David Brown',
    email: 'david@bandoskomar.org',
    role: 'viewer',
    status: 'active',
    lastLogin: '5 minutes ago',
    createdAt: '2024-01-25'
  },
  {
    id: 6,
    name: 'Lisa Garcia',
    email: 'lisa@bandoskomar.org',
    role: 'admin',
    status: 'active',
    lastLogin: '1 hour ago',
    createdAt: '2024-01-12'
  },
  {
    id: 7,
    name: 'Tom Anderson',
    email: 'tom@bandoskomar.org',
    role: 'editor',
    status: 'inactive',
    lastLogin: '3 days ago',
    createdAt: '2024-01-08'
  },
  {
    id: 8,
    name: 'Emily Davis',
    email: 'emily@bandoskomar.org',
    role: 'viewer',
    status: 'active',
    lastLogin: '30 minutes ago',
    createdAt: '2024-01-18'
  }
])

// Computed properties
const filteredUsers = computed(() => {
  let filtered = users.value

  // Search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(user => 
      user.name.toLowerCase().includes(query) ||
      user.email.toLowerCase().includes(query)
    )
  }

  // Role filter
  if (selectedRole.value) {
    filtered = filtered.filter(user => user.role === selectedRole.value)
  }

  // Status filter
  if (selectedStatus.value) {
    filtered = filtered.filter(user => user.status === selectedStatus.value)
  }

  // Sort
  filtered.sort((a, b) => {
    let aValue = a[sortField.value]
    let bValue = b[sortField.value]
    
    if (typeof aValue === 'string') {
      aValue = aValue.toLowerCase()
      bValue = bValue.toLowerCase()
    }
    
    if (sortDirection.value === 'asc') {
      return aValue < bValue ? -1 : aValue > bValue ? 1 : 0
    } else {
      return aValue > bValue ? -1 : aValue < bValue ? 1 : 0
    }
  })

  return filtered
})

const totalPages = computed(() => Math.ceil(filteredUsers.value.length / itemsPerPage.value))

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return filteredUsers.value.slice(start, end)
})

const visiblePages = computed(() => {
  const pages = []
  const total = totalPages.value
  const current = currentPage.value
  
  if (total <= 7) {
    for (let i = 1; i <= total; i++) {
      pages.push(i)
    }
  } else {
    if (current <= 4) {
      for (let i = 1; i <= 5; i++) {
        pages.push(i)
      }
      pages.push('...', total)
    } else if (current >= total - 3) {
      pages.push(1, '...')
      for (let i = total - 4; i <= total; i++) {
        pages.push(i)
      }
    } else {
      pages.push(1, '...')
      for (let i = current - 1; i <= current + 1; i++) {
        pages.push(i)
      }
      pages.push('...', total)
    }
  }
  
  return pages.filter(page => page !== '...' || pages.indexOf(page) === pages.lastIndexOf(page))
})

// Methods
const sortBy = (field) => {
  if (sortField.value === field) {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortField.value = field
    sortDirection.value = 'asc'
  }
}

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedUsers.value = paginatedUsers.value.map(user => user.id)
  } else {
    selectedUsers.value = []
  }
}

const clearSelection = () => {
  selectedUsers.value = []
  selectAll.value = false
}

const addUser = () => {
  if (newUser.value.name && newUser.value.email) {
    users.value.push({
      id: Date.now(),
      name: newUser.value.name,
      email: newUser.value.email,
      role: newUser.value.role,
      status: newUser.value.status,
      lastLogin: 'Never',
      createdAt: new Date().toISOString().split('T')[0]
    })
    
    newUser.value = { name: '', email: '', role: 'viewer', status: 'active' }
    showAddModal.value = false
  }
}

const editUser = (user) => {
  console.log('Edit user:', user)
  // Implement edit functionality
}

const toggleUserStatus = (user) => {
  user.status = user.status === 'active' ? 'inactive' : 'active'
}

const deleteUser = (userId) => {
  if (confirm('Are you sure you want to delete this user?')) {
    users.value = users.value.filter(user => user.id !== userId)
    selectedUsers.value = selectedUsers.value.filter(id => id !== userId)
  }
}

const bulkActivate = () => {
  selectedUsers.value.forEach(userId => {
    const user = users.value.find(u => u.id === userId)
    if (user) user.status = 'active'
  })
  clearSelection()
}

const bulkDeactivate = () => {
  selectedUsers.value.forEach(userId => {
    const user = users.value.find(u => u.id === userId)
    if (user) user.status = 'inactive'
  })
  clearSelection()
}

const bulkDelete = () => {
  if (confirm(`Are you sure you want to delete ${selectedUsers.value.length} user(s)?`)) {
    users.value = users.value.filter(user => !selectedUsers.value.includes(user.id))
    clearSelection()
  }
}

// Watch for changes in filtered users to reset pagination
watch(filteredUsers, () => {
  currentPage.value = 1
})

// Watch for changes in selected users to update select all checkbox
watch(selectedUsers, () => {
  selectAll.value = selectedUsers.value.length === paginatedUsers.value.length && paginatedUsers.value.length > 0
}, { deep: true })
</script>
