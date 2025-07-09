import api from '@/plugin/axios';

// Get all videos
export const getVideos = async () => {
  const response = await api.get('/videos');
  return response.data;
};

// Get a single video by ID
export const getVideoById = async (id) => {
  const response = await api.get(`/videos/${id}`);
  return response.data;
};

// Create a new video
export const createVideo = async (videoData) => {
  const response = await api.post('/videos', videoData);
  return response.data;
};

// Update an existing video
export const updateVideo = async (id, videoData) => {
  const response = await api.put(`/videos/${id}`, videoData);
  return response.data;
};

// Delete a video
export const deleteVideo = async (id) => {
  const response = await api.delete(`/videos/${id}`);
  return response.data;
};