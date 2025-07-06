import axios from "axios";

const apiInstance = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api",
  withCredentials: true, // This is important for CSRF protection
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});
// Ad d a request interceptor to include the beerer token if available
apiInstance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token"); // Assuming you store the token in localStorage
    if (token) {
      config.headers["Authorization"] = `Bearer ${token}`;
    } else {
      delete config.headers["Authorization"]; // Remove the header if no token is present
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Interceptor to handle errors globally
apiInstance.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      // Redirect to login page if unauthorized
      window.location.href = "/login";
    }
    return Promise.reject(error);
  }
);
// Export the configured axios instance
export default apiInstance;
