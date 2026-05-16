export const STATUS_COLORS: Record<string, string> = {
  new: 'bg-slate-100 text-slate-700',
  profile_complete: 'bg-blue-100 text-blue-700',
  under_review: 'bg-amber-100 text-amber-700',
  shortlisted: 'bg-amber-100 text-amber-700',
  interview_scheduled: 'bg-blue-100 text-blue-700',
  interviewed: 'bg-green-100 text-green-800',
  offer_received: 'bg-purple-100 text-purple-700',
  accepted: 'bg-emerald-100 text-emerald-700',
  visa_processing: 'bg-cyan-100 text-cyan-700',
  visa_approved: 'bg-emerald-100 text-emerald-700',
  visa_rejected: 'bg-red-100 text-red-700',
  enrolled: 'bg-emerald-100 text-emerald-700',
  closed: 'bg-red-100 text-red-700',
  on_hold: 'bg-slate-100 text-slate-500',
  // Interview statuses
  pending: 'bg-slate-100 text-slate-600',
  requested: 'bg-slate-100 text-slate-600',
  arranged: 'bg-blue-100 text-blue-700',
  confirmed: 'bg-green-100 text-green-800',
  completed: 'bg-emerald-100 text-emerald-700',
  cancelled: 'bg-red-100 text-red-700',
  rescheduled: 'bg-blue-100 text-blue-700',
  no_show: 'bg-red-100 text-red-700',
};

export const MEDIUM_LABEL: Record<string, string> = {
  zoom: '📹 Zoom',
  google_meet: '📹 Google Meet',
  teams: '📹 Teams',
  phone: '📞 Phone',
  in_person: '🏢 In Person',
  online: '💻 Online',
};
