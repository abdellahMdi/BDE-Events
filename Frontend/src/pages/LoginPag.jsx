import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

// Inside your component:
const navigate = useNavigate();
const { login } = useAuth();

const handleSubmit = async (e) => {
  e.preventDefault();
  try {
    const data = await login(email, password);

    // Dynamic redirect based on user role returned from backend
    const userRole = (data.user?.role || '').toLowerCase();
    if (userRole === 'admin') {
      navigate('/admin/dashboard', { replace: true });
    } else {
      navigate('/events', { replace: true });
    }
  } catch (err) {
    console.error('Login failed:', err);
  }
};