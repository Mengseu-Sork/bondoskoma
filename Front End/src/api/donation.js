import api from '@/plugin/axios';

// Get all donets
export const getDonets = async () => {
  const response = await api.get('/donations');
  return response.data;
};

// Get a single donet by ID
export const getDonetById = async (id) => {
  const response = await api.get(`/donations/${id}`);
  return response.data;
};

// Create a new donet
export const createDonet = async (donetData) => {
  const response = await api.post('/donations', donetData);
  return response.data;
};

// Update an existing donet
export const updateDonet = async (id, donetData) => {
  const response = await api.put(`/donations/${id}`, donetData);
  return response.data;
};

// Delete a donet
export const deleteDonet = async (id) => {
  const response = await api.delete(`/donations/${id}`);
  return response.data;
};