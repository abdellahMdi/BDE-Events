import { Link } from 'react-router-dom';

export default function AdminEventsTable({ events, onDelete }) {
  const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
  };

  return (
    <div className="bg-white rounded-3xl border border-stone-200 shadow-sm overflow-hidden">
      <div className="p-6 border-b border-stone-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h2 className="text-lg font-bold text-stone-900">Gestion des Événements</h2>
          <p className="text-xs text-stone-500">Liste globale de tous les événements créés sur la plateforme.</p>
        </div>
      </div>

      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm text-stone-600">
          <thead className="bg-stone-50 text-[11px] text-stone-400 uppercase font-bold tracking-wider">
            <tr>
              <th className="px-6 py-4">Titre</th>
              <th className="px-6 py-4">Lieu</th>
              <th className="px-6 py-4">Date & Heure</th>
              <th className="px-6 py-4">Prix</th>
              <th className="px-6 py-4">Places</th>
              <th className="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-stone-100">
            {events.length > 0 ? (
              events.map((event) => (
                <tr key={event.id} className="hover:bg-stone-50/80 transition-colors">
                  <td className="px-6 py-4 font-bold text-stone-900">{event.title}</td>
                  <td className="px-6 py-4 text-stone-600">{event.place}</td>
                  <td className="px-6 py-4 text-stone-600 font-medium">
                    {formatDate(event.date)} <span className="text-stone-400 text-xs">à</span> {event.houre}
                  </td>
                  <td className="px-6 py-4 font-extrabold text-emerald-800">
                    {event.price} DH
                  </td>
                  <td className="px-6 py-4">
                    <span className="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-semibold">
                      {event.places_limite} places
                    </span>
                  </td>
                  <td className="px-6 py-4 text-right">
                    <div className="flex items-center justify-end space-x-2">
                      <Link
                        to={`/admin/events/edit/${event.id}`}
                        className="inline-flex items-center space-x-1 px-3 py-1.5 text-xs font-semibold text-stone-700 bg-stone-100 hover:bg-emerald-50 hover:text-emerald-800 rounded-xl transition-all border border-stone-200 hover:border-emerald-200"
                      >
                        <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Modifier</span>
                      </Link>

                      <button
                        onClick={() => onDelete(event.id)}
                        type="button"
                        className="inline-flex items-center space-x-1 px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-all border border-rose-200"
                      >
                        <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Supprimer</span>
                      </button>
                    </div>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6" className="px-6 py-12 text-center text-stone-400 text-sm">
                  <svg className="w-10 h-10 mx-auto mb-3 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                  </svg>
                  <p className="font-medium text-stone-500">Aucun événement n'a été trouvé.</p>
                  <p className="text-xs text-stone-400 mt-1">Commencez par ajouter votre premier événement ci-dessus.</p>
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
