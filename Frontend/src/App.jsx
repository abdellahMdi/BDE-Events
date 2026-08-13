import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import ProtectedRoute from './components/ProtectedRoute';
import LoginPage from './pages/LoginPage';
import EventsPage from './pages/EventsPage';
import MyTicketsPage from './pages/MyTicketsPage';
import AdminDashboardPage from './pages/AdminDashboardPage';
import CreateEditEventPage from './pages/CreateEditEventPage';

export default function App() {
  return (
    <BrowserRouter>
      <AuthProvider>
        <Routes>
          {/* Public Auth Route */}
          <Route path="/login" element={<LoginPage />} />

          {/* Student Routes */}
          <Route element={<ProtectedRoute allowedRoles={['student', 'user']} />}>
            <Route path="/events" element={<EventsPage />} />
            <Route path="/my-tickets" element={<MyTicketsPage />} />
          </Route>

          {/* Admin Routes */}
          <Route element={<ProtectedRoute allowedRoles={['admin']} />}>
            <Route path="/admin/dashboard" element={<AdminDashboardPage />} />
            <Route path="/admin/events/create" element={<CreateEditEventPage />} />
            <Route path="/admin/events/edit/:id" element={<CreateEditEventPage />} />
          </Route>

          {/* Default Redirect */}
          <Route path="/" element={<Navigate to="/login" replace />} />
          <Route path="*" element={<Navigate to="/login" replace />} />
        </Routes>
      </AuthProvider>
    </BrowserRouter>
  );
}