import api from '@/plugin/axios';

// Get all applies
export const getApplies = async () => {
  const response = await api.get('/applies');
  return response.data;
};

// Get a single apply by ID
export const getApplyById = async (id) => {
  const response = await api.get(`/applies/${id}`);
  return response.data;
};

// Create a new apply
export const createApply = async (applyData) => {
  const response = await api.post('/applies', applyData, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  });
  return response.data;
};

// Delete a apply
export const deleteApply = async (id) => {
  const response = await api.delete(`/applies/${id}`);
  return response.data;
};
