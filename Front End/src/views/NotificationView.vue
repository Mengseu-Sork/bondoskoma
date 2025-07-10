```vue
<template>
  <admin-aside>
    <div class="p-6">
      <!-- Header with Title, Sort, and Mark All -->
      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
        <div class="flex items-center gap-4">
          <select
            v-model="sortOrder"
            class="text-sm border border-gray-300 rounded-lg py-2 px-3 bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
          >
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
          </select>
          <button
            v-if="notifications.length > 0 && unreadCount > 0"
            @click="confirmMarkAllAsRead"
            class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:bg-blue-50 px-3 py-2 rounded-lg transition-all duration-200"
          >
            Mark All as Read
          </button>
        </div>
      </div>

      <!-- Notifications List -->
      <div v-if="isLoading" class="text-center text-gray-500 py-6">
        <svg class="animate-spin mx-auto h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        Loading notifications...
      </div>
      <div v-else class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="max-h-[70vh] overflow-y-auto">
          <div
            v-for="notification in sortedNotifications"
            :key="notification.id"
            class="px-5 py-4 hover:bg-gray-50 transition-all duration-200 border-b border-gray-100 last:border-b-0"
          >
            <div class="flex items-start space-x-4">
              <div :class="[
                'w-3 h-3 rounded-full mt-2.5 flex-shrink-0',
                notification.read ? 'bg-gray-300' : 'bg-blue-500'
              ]"></div>
              <div class="flex-1">
                <div class="flex justify-between items-start">
                  <div>
                    <p class="text-sm font-semibold text-gray-900">{{ notification.name }}</p>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ notification.paragraph }}</p>
                    <p class="text-xs text-gray-500 mt-1">Received: {{ notification.time }}</p>
                    <p v-if="notification.phone" class="text-xs text-gray-500 mt-1">Phone: {{ notification.phone }}</p>
                  </div>
                  <div class="flex gap-2">
                    <button
                      @click.stop="openViewMoreModal(notification)"
                      class="text-xs text-blue-600 hover:text-blue-700 font-medium hover:underline"
                    >
                      View More
                    </button>
                    <button
                      v-if="!notification.read"
                      @click.stop="markAsRead(notification.id)"
                      class="text-xs text-green-600 hover:text-green-700 font-medium hover:underline"
                    >
                      Mark as Read
                    </button>
                    <button
                      @click.stop="deleteNotification(notification.id)"
                      class="text-xs text-red-600 hover:text-red-700 font-medium hover:underline"
                    >
                      Delete
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="notifications.length === 0" class="px-5 py-4 text-center text-gray-500">
            No notifications available.
          </div>
        </div>
        <div class="px-5 py-3 border-t border-gray-100">
          <button
            @click="refreshNotifications"
            class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:bg-blue-50 px-3 py-2 rounded-lg transition-all duration-200"
          >
            Refresh Notifications
          </button>
        </div>
      </div>

      <!-- View More Modal -->
      <div v-if="showViewMoreModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 p-6">
          <h2 class="text-lg font-bold text-gray-900 mb-4">Notification Details</h2>
          <div class="space-y-3">
            <p><span class="font-medium text-gray-700">Name:</span> {{ selectedNotification.name }}</p>
            <p><span class="font-medium text-gray-700">Phone:</span> {{ selectedNotification.phone }}</p>
            <p><span class="font-medium text-gray-700">Message:</span> {{ selectedNotification.paragraph }}</p>
            <p><span class="font-medium text-gray-700">Received:</span> {{ selectedNotification.time }}</p>
            <p><span class="font-medium text-gray-700">Last Updated:</span> {{ selectedNotification.updated_at }}</p>
            <p>
              <span class="font-medium text-gray-700">Status:</span>
              <span :class="selectedNotification.read ? 'text-green-600' : 'text-blue-600'">
                {{ selectedNotification.read ? 'Read' : 'Unread' }}
              </span>
            </p>
          </div>
          <div class="flex justify-end gap-3 mt-4">
            <button
              v-if="!selectedNotification.read"
              @click="markAsRead(selectedNotification.id); showViewMoreModal = false"
              class="px-4 py-2 text-sm text-green-600 hover:bg-green-50 rounded-lg"
            >
              Mark as Read
            </button>
            <button
              @click="deleteNotification(selectedNotification.id); showViewMoreModal = false"
              class="px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg"
            >
              Delete
            </button>
            <button
              @click="showViewMoreModal = false"
              class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-lg"
            >
              Close
            </button>
          </div>
        </div>
      </div>

      <!-- Toast Notifications -->
      <div v-if="toastMessage" class="fixed bottom-4 right-4 bg-gray-900 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ toastMessage }}
      </div>
    </div>
  </admin-aside>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import AdminAside from '@/components/AdminAside.vue'
import api from '@/plugin/axios'

const notifications = ref([])
const sortOrder = ref('newest')
const isLoading = ref(false)
const showViewMoreModal = ref(false)
const selectedNotification = ref({})
const toastMessage = ref('')

// Load read and deleted statuses from localStorage
const loadReadStatuses = () => {
  return JSON.parse(localStorage.getItem('notificationReadStatuses') || '{}')
}
const loadDeletedIds = () => {
  return JSON.parse(localStorage.getItem('deletedNotificationIds') || '[]')
}

// Save read and deleted statuses to localStorage
const saveReadStatuses = (readStatuses) => {
  localStorage.setItem('notificationReadStatuses', JSON.stringify(readStatuses))
}
const saveDeletedIds = (deletedIds) => {
  localStorage.setItem('deletedNotificationIds', JSON.stringify(deletedIds))
}

// Compute unread notifications count
const unreadCount = computed(() => {
  return notifications.value.filter(n => !n.read).length
})

// Compute sorted notifications
const sortedNotifications = computed(() => {
  return [...notifications.value].sort((a, b) => {
    const dateA = new Date(a.created_at)
    const dateB = new Date(b.created_at)
    return sortOrder.value === 'newest' ? dateB - dateA : dateA - dateB
  })
})

// Fetch notifications from API
const fetchNotifications = async () => {
  isLoading.value = true
  try {
    const response = await api.get('/contact')
    const readStatuses = loadReadStatuses()
    const deletedIds = loadDeletedIds()
    notifications.value = response.data.contact
      .filter(contact => !deletedIds.includes(contact.id))
      .map(contact => ({
        id: contact.id,
        name: contact.name,
        paragraph: contact.paragraph,
        phone: contact.phone,
        time: new Date(contact.created_at).toLocaleString(),
        created_at: contact.created_at,
        updated_at: new Date(contact.updated_at).toLocaleString(),
        read: readStatuses[contact.id] || false
      }))
  } catch (error) {
    console.error('Error fetching notifications:', error)
    showToast('Failed to fetch notifications. Please try again.')
  } finally {
    isLoading.value = false
  }
}

// Mark a single notification as read
const markAsRead = async (id) => {
  try {
    const readStatuses = loadReadStatuses()
    readStatuses[id] = true
    saveReadStatuses(readStatuses)
    const notification = notifications.value.find(n => n.id === id)
    if (notification) {
      notification.read = true
    }
    // Attempt API update (optional)
    await api.patch(`/contact/${id}`, { read: true }).catch(() => {})
    showToast('Notification marked as read.')
  } catch (error) {
    console.error('Error marking notification as read:', error)
    showToast('Failed to mark notification as read.')
  }
}

// Confirm and mark all notifications as read
const confirmMarkAllAsRead = () => {
  if (confirm('Are you sure you want to mark all notifications as read?')) {
    markAllAsRead()
  }
}

// Mark all notifications as read
const markAllAsRead = async () => {
  try {
    const readStatuses = loadReadStatuses()
    notifications.value.forEach(n => {
      readStatuses[n.id] = true
      n.read = true
    })
    saveReadStatuses(readStatuses)
    // Attempt API update (optional)
    await Promise.all(
      notifications.value
        .filter(n => n.read)
        .map(n => api.patch(`/contact/${n.id}`, { read: true }).catch(() => {}))
    )
    showToast('All notifications marked as read.')
  } catch (error) {
    console.error('Error marking all notifications as read:', error)
    showToast('Failed to mark all notifications as read.')
  }
}

// Delete a notification
const deleteNotification = async (id) => {
  if (confirm('Are you sure you want to delete this notification?')) {
    try {
      const deletedIds = loadDeletedIds()
      deletedIds.push(id)
      saveDeletedIds(deletedIds)
      notifications.value = notifications.value.filter(n => n.id !== id)
      // Attempt API delete (optional)
      await api.delete(`/contact/${id}`).catch(() => {})
      showToast('Notification deleted.')
    } catch (error) {
      console.error('Error deleting notification:', error)
      showToast('Failed to delete notification.')
    }
  }
}

// Open view more modal
const openViewMoreModal = (notification) => {
  selectedNotification.value = notification
  showViewMoreModal.value = true
}

// Refresh notifications
const refreshNotifications = async () => {
  await fetchNotifications()
}

// Show toast message
const showToast = (message) => {
  toastMessage.value = message
  setTimeout(() => {
    toastMessage.value = ''
  }, 3000)
}

// Fetch notifications on component mount
onMounted(() => {
  fetchNotifications()
})
</script>
```