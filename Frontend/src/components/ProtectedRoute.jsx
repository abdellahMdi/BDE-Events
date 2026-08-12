import { Navigate, Outlet } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function ProtectedRoute({ allowedRoles }) {
  const { user, loading } = useAuth();

  // 1. Wait for session check to complete
  if (loading) {
    return (
      <div className="min-h-screen bg-stone-100 flex items-center justify-center text-xs font-semibold text-stone-500">
        Chargement...
      </div>
    );
  }

  // 2. Redirect unauthenticated users
  if (!user) {
    return <Navigate to="/login" replace />;
  }

  // 3. Check role access
  const userRole = (user.role || '').toLowerCase();
  const hasPermission = allowedRoles.some((role) => role.toLowerCase() === userRole);

  if (!hasPermission) {
    return userRole === 'admin' 
      ? <Navigate to="/admin/dashboard" replace /> 
      : <Navigate to="/events" replace />;
  }

  // 4. Must render Outlet for nested layout routes
  return <Outlet />;
}