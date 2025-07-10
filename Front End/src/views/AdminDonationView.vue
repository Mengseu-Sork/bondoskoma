<template>
  <AdminAside>
    <div class="p-6 bg-white">
      <h1 class="text-2xl font-bold mb-6">Donation Management</h1>

      <!-- Filter Status -->
      <div class="mb-4 flex items-center gap-4">
        <label for="filter" class="font-semibold">Filter by Status:</label>
        <select
          id="filter"
          v-model="filterStatus"
          class="border border-gray-300 rounded px-3 py-1"
          @change="fetchDonations"
        >
          <option value="">All</option>
          <option value="pending">Pending</option>
          <option value="confirmed">Confirmed</option>
        </select>
      </div>

      <!-- Donations Table -->
      <table class="min-w-full border border-gray-200 rounded-md">
        <thead class="bg-gray-50">
          <tr>
            <th class="border-b px-4 py-2 font-semibold text-sm text-left">ID</th>
            <th class="border-b px-4 py-2 font-semibold text-sm text-left">Name</th>
            <th class="border-b px-4 py-2 text-left font-semibold text-sm ">Email</th>
            <th class="border-b px-4 py-2 text-left font-semibold text-sm ">Amount</th>
            <th class="border-b px-4 py-2 text-left font-semibold text-sm ">Payment</th>
            <th class="border-b px-4 py-2 text-left font-semibold text-sm ">Status</th>
            <th class="border-b px-4 py-2 text-left font-semibold text-sm ">Date</th>
            <th class="border-b px-4 py-2 text-center font-semibold text-sm ">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(donation, index) in donations" :key="donation.id">
            <td class="border-b px-4 py-2">{{ index + 1 }}</td>
            <td class="border-b px-4 py-2">{{ donation.first_name }} {{ donation.last_name }}</td>
            <td class="border-b px-4 py-2">{{ donation.email }}</td>
            <td class="border-b px-4 py-2">${{ donation.amount }}</td>
            <td class="border-b px-4 py-2 capitalize">{{ donation.payment_method || '-' }}</td>
            <td
              class="border-b px-4 py-2 capitalize"
              :class="{
                'text-orange-500 font-bold': donation.status === 'pending',
                'text-green-500 font-bold': donation.status === 'confirmed',
              }"
            >
              {{ donation.status }}
            </td>
            <td class="border-b px-4 py-2">{{ new Date(donation.created_at).toLocaleDateString() }}</td>
            <td class="border-b px-6 py-2">
                <div class="flex justify-center items-center">
                    <button
                    v-if="donation.status === 'pending'"
                    @click="confirmDonation(donation.id)"
                    class="px-2 py-1 mt-2 text-green-600 rounded hover:text-green-700"
                    :disabled="loadingIds.has(donation.id)"
                    title="Confirm Donation"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" class="w-6 h-6 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4 -4m5 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
                    </svg>
                    </button>

                    <button
                    @click="deleteDonation(donation.id)"
                    class="px-2 py-1 text-red-600 rounded hover:text-red-700"
                    :disabled="loadingIds.has(donation.id)"
                    title="Delete Donation"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    </button>
                </div>
                </td>
        </tr>

        <tr v-if="donations.length === 0">
            <td colspan="8" class="text-center p-4 text-gray-500">No donations found.</td>
        </tr>
        </tbody>
      </table>

      <div v-if="loading" class="mt-4 text-center text-blue-600">Loading donations...</div>
      <div v-if="error" class="mt-4 text-center text-red-600">{{ error }}</div>
    </div>
  </AdminAside>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import AdminAside from '@/components/AdminAside.vue';
import { getDonets, confirmDonet, deleteDonet } from '@/api/donation';

const donations = ref([]);
const loading = ref(false);
const error = ref(null);
const filterStatus = ref('');
const page = ref(1);
const perPage = 10;
const loadingIds = reactive(new Set());

async function fetchDonations() {
  loading.value = true;
  error.value = null;
  try {
    const allDonations = await getDonets();
    let filtered = filterStatus.value
      ? allDonations.filter((d) => d.status === filterStatus.value)
      : allDonations;

    // Pagination (client side)
    const start = (page.value - 1) * perPage;
    donations.value = filtered.slice(start, start + perPage);
  } catch (err) {
    error.value = err.message || 'Failed to load donations.';
  } finally {
    loading.value = false;
  }
}

function changePage(newPage) {
  if (newPage < 1) return;
  page.value = newPage;
  fetchDonations();
}

async function confirmDonation(id) {
  loadingIds.add(id);
  try {
    await confirmDonet(id);
    await fetchDonations();
  } catch (err) {
    alert('Failed to confirm donation: ' + (err.message || 'Please try again.'));
  } finally {
    loadingIds.delete(id);
  }
}

async function deleteDonation(id) {
  if (!confirm('Are you sure you want to delete this donation?')) return;

  loadingIds.add(id);
  try {
    await deleteDonet(id);
    await fetchDonations();
  } catch (err) {
    alert('Failed to delete donation: ' + (err.message || 'Please try again.'));
  } finally {
    loadingIds.delete(id);
  }
}

onMounted(() => {
  fetchDonations();
});
</script>
