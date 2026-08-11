import AuthSideBanner from '../components/AuthSideBanner';
import LoginForm from '../components/LoginForm';

export default function LoginPage() {
  return (
    <div className="bg-stone-100 text-stone-800 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
      <div className="w-full max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden border border-stone-200 grid grid-cols-1 lg:grid-cols-12 min-h-[620px]">
        <AuthSideBanner />
        <LoginForm />
      </div>
    </div>
  );
}
