<template>
  <div class="p-8 max-w-6xl mx-auto">
    <div v-if="job">
      <!-- Job Title & Info -->
      <h1 class="text-2xl md:text-3xl font-bold text-blue-500 mb-2">{{ job.title }}</h1>
      <div class="text-gray-500 mb-4">
        <span class="font-medium text-lg">{{ job.type }}</span> · 
        <span class="text-lg">{{ job.location }}</span> · 
        <span class="text-lg">Posted {{ job.posted_date }}</span>
      </div>

      <!-- Responsibilities -->
      <div class="bg-blue-50 p-6 rounded-md shadow mb-6">
        <h2 class="text-2xl font-semibold text-blue-900 mb-4">JOB RESPONSIBILITIES</h2>
        <ul class="list-disc text-lg list-inside space-y-2 text-gray-700">
          <li v-for="(item, index) in job.responsibilities" :key="'resp-' + index">{{ item }}</li>
        </ul>
      </div>

      <!-- Qualifications -->
      <div class="bg-blue-100 p-6 rounded-md shadow mb-6">
        <h2 class="text-2xl font-semibold text-blue-900 mb-4">QUALIFICATIONS</h2>
        <ul class="list-disc list-inside text-lg space-y-2 text-gray-700">
          <li v-for="(item, index) in job.qualifications" :key="'qual-' + index">{{ item }}</li>
        </ul>
      </div>

      <!-- Apply & Back Buttons -->
      <div class="flex items-center gap-4">
        <button
          @click="showForm = true"
          class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600"
        >
          Apply
        </button>

        <router-link
          to="/jobs"
          class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 text-center"
        >
          Back
        </router-link>
      </div>
    </div>

    <!-- Job Not Found -->
    <div v-else>
      <p class="text-red-500">Job not found.</p>
    </div>

    <!-- Modal Form -->
    <div
      v-if="showForm"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
        <button
          @click="showForm = false"
          class="absolute top-2 right-2 text-gray-500 hover:text-black"
        >
          &times;
        </button>
        <h3 class="text-2xl font-semibold mb-4 text-gray-700">Application Form</h3>
        <form @submit.prevent="submitApplication" class="space-y-4">
          <div>
            <label class="block font-medium mb-2 text-gray-600">Full Name</label>
            <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" required placeholder="Enter FullName" />
          </div>
          <div>
            <label class="block font-medium mb-2 text-gray-600">Email</label>
            <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" required placeholder="Enter Email" />
          </div>
          <div>
            <label class="block font-medium mb-2 text-gray-600">Phone Number</label>
            <input v-model="form.phone" type="phone" class="w-full border rounded px-3 py-2" required placeholder="Enter Number" />
          </div>
          <div>
            <label class="block font-medium mb-2 text-gray-600">Upload CV (PDF or Word)</label>
            <input
              type="file"
              accept=".pdf,.doc,.docx"
              @change="handleFileUpload"
              class="w-full border rounded px-3 py-2"
              required
            />
          </div>
          <button
            type="submit"
            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700"
          >
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { getJobById } from '@/api/job'
import { createApply } from '@/api/applies'

const route = useRoute()
const jobId = Number(route.params.id)
const job = ref(null)
const showForm = ref(false)

const form = ref({
  name: '',
  email: '',
  phone: '',
  file: null
})

onMounted(async () => {
  const data = await getJobById(jobId)

  if (data) {
    try {
      if (typeof data.responsibilities === 'string') {
        data.responsibilities = JSON.parse(data.responsibilities)
      }
      if (typeof data.qualifications === 'string') {
        data.qualifications = JSON.parse(data.qualifications)
      }
    } catch (e) {
      console.error('Failed to parse responsibilities or qualifications:', e)
      data.responsibilities = []
      data.qualifications = []
    }
    job.value = data
  } else {
    job.value = null
  }
})

const handleFileUpload = (event) => {
  const file = event.target.files[0]
  if (
    file &&
    (file.type === 'application/pdf' ||
      file.name.endsWith('.doc') ||
      file.name.endsWith('.docx'))
  ) {
    form.value.file = file
  } else {
    alert('Please upload a valid PDF or Word document.')
    event.target.value = ''
  }
}

const submitApplication = async () => {
  if (
    !form.value.name ||
    !form.value.email ||
    !form.value.phone ||
    !form.value.file
  ) {
    alert('Please fill in all fields and upload your CV.')
    return
  }

  const formData = new FormData()
  formData.append('job_announcements_id', jobId)
  formData.append('name', form.value.name)
  formData.append('email', form.value.email)
  formData.append('phone', form.value.phone)
  formData.append('cv', form.value.file)

  try {
    await createApply(formData)
    alert(`Thank you for applying, ${form.value.name}!`)
    showForm.value = false
    form.value = {
      name: '',
      email: '',
      phone: '',
      file: null
    }
  } catch (error) {
    console.error('Failed to submit application:', error)
    alert('Failed to submit. Please try again.')
  }
}
</script>
