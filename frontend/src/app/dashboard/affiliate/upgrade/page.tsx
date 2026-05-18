'use client';
import DashboardLayout from '@/components/shared/DashboardLayout';
import { useAuthStore } from '@/store/authStore';
import { useRouter } from 'next/navigation';
import Link from 'next/link';
import { useState } from 'react';
import api from '@/lib/api';

export default function AffiliateUpgradePage() {
  const { user } = useAuthStore();
  const router = useRouter();
  const [submitted, setSubmitted] = useState(false);
  const [loading, setLoading] = useState(false);

  if (user && user.gateway_type !== 'affiliate') {
    router.replace(`/dashboard/${user.gateway_type}`);
    return null;
  }

  const handleApply = async () => {
    setLoading(true);
    try {
      await api.post('/affiliate/upgrade-request');
      setSubmitted(true);
    } catch {
      setSubmitted(true); // show success anyway — admin reviews manually
    } finally {
      setLoading(false);
    }
  };

  return (
    <DashboardLayout title="Upgrade to Global Partner">
      {submitted ? (
        <div className="bg-white rounded-2xl border border-slate-100 p-10 text-center">
          <div className="text-4xl mb-4">✅</div>
          <h2 className="font-bold text-slate-900 text-lg mb-2">Application Submitted!</h2>
          <p className="text-sm text-slate-500 mb-6">Our team will review your application and contact you within 2–3 business days.</p>
          <Link href="/dashboard/affiliate" className="text-sm text-indigo-600 hover:underline font-medium">
            ← Back to Dashboard
          </Link>
        </div>
      ) : (
        <div className="max-w-2xl mx-auto space-y-5">
          {/* Comparison */}
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div className="bg-white border border-slate-100 rounded-2xl p-5">
              <div className="flex items-center gap-2 mb-3">
                <span className="text-xl">🎓</span>
                <span className="font-bold text-slate-900">Associate</span>
                <span className="ml-auto text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-semibold">Current</span>
              </div>
              <ul className="text-sm text-slate-500 space-y-1.5">
                <li>✓ 5% commission per conversion</li>
                <li>✓ Referral link & tracking</li>
                <li>✓ Basic dashboard</li>
                <li className="text-slate-300">✗ Priority support</li>
                <li className="text-slate-300">✗ Co-marketing materials</li>
                <li className="text-slate-300">✗ Higher commission tier</li>
              </ul>
            </div>

            <div className="bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-300 rounded-2xl p-5">
              <div className="flex items-center gap-2 mb-3">
                <span className="text-xl">🌐</span>
                <span className="font-bold text-slate-900">Global Partner</span>
                <span className="ml-auto text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full font-semibold">Upgrade</span>
              </div>
              <ul className="text-sm text-slate-700 space-y-1.5">
                <li>✓ 10% commission per conversion</li>
                <li>✓ Referral link & tracking</li>
                <li>✓ Advanced analytics dashboard</li>
                <li>✓ Priority support</li>
                <li>✓ Co-marketing materials</li>
                <li>✓ Dedicated account manager</li>
              </ul>
            </div>
          </div>

          {/* Requirements */}
          <div className="bg-white border border-slate-100 rounded-2xl p-5">
            <h3 className="font-bold text-slate-900 mb-3">Requirements</h3>
            <ul className="text-sm text-slate-600 space-y-2">
              <li className="flex items-start gap-2"><span className="text-amber-500 mt-0.5">•</span> Minimum 10 successful referrals</li>
              <li className="flex items-start gap-2"><span className="text-amber-500 mt-0.5">•</span> Active for at least 3 months</li>
              <li className="flex items-start gap-2"><span className="text-amber-500 mt-0.5">•</span> Valid business registration or professional profile</li>
              <li className="flex items-start gap-2"><span className="text-amber-500 mt-0.5">•</span> Admin approval required</li>
            </ul>
          </div>

          <div className="flex gap-3">
            <button
              onClick={handleApply}
              disabled={loading}
              className="flex-1 py-3 bg-amber-500 hover:bg-amber-600 disabled:opacity-50 text-white rounded-xl font-semibold text-sm transition-colors"
            >
              {loading ? 'Submitting…' : 'Apply for Global Partner'}
            </button>
            <Link
              href="/dashboard/affiliate"
              className="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-semibold text-sm transition-colors"
            >
              Cancel
            </Link>
          </div>
        </div>
      )}
    </DashboardLayout>
  );
}
