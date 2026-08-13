// src/components/ProtectedRoute.jsx
import { Navigate, Outlet } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function ProtectedRoute({ allowedRoles = [] }) {
  const { user, loading } = useAuth();

  if (loading) return null;

  if (!user) {
    return <Navigate to="/login" replace />;
  }

  // Safe lowercasing with fallbacks
  const userRole = (user?.role || '').toString().toLowerCase();
  const hasPermission = allowedRoles.some(role => role.toLowerCase() === userRole);

  if (!hasPermission) {
    return userRole === 'admin' 
      ? <Navigate to="/admin/dashboard" replace /> 
      : <Navigate to="/events" replace />;
  }

  return <Outlet />;
}