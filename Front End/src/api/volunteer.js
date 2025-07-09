import api from '@/plugin/axios';

export const getVolunteers = async () => {
  const res = await api.get('/volunteers');
  return res.data.volunteer ? res.data.volunteer : res.data;
};

export const createVolunteer = async (formData) => {
  const res = await api.post('/volunteers', formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  });
  return res.data;
};

export const updateVolunteer = async (id, formData) => {
  const res = await api.post(`/volunteers/${id}?_method=PUT`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  });
  return res.data;
};

export const deleteVolunteer = async (id) => {
  const res = await api.delete(`/volunteers/${id}`);
  return res.data;
};
