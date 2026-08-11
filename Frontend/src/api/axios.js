import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // Adjust to your backend URL
  withCredentials: true, // Enables cookie storage for Sanctum
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

// Helper to initialize CSRF protection before state-changing requests
export const getCsrfToken = () =>
  axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });

export default api;
