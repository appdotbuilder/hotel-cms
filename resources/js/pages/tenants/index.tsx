import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Tenant {
    id: number;
    name: string;
    slug: string;
    domain: string | null;
    database_name: string;
    status: 'active' | 'inactive' | 'suspended';
    created_at: string;
    users_count?: number;
}

interface Props {
    tenants: {
        data: Tenant[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    [key: string]: unknown;
}

export default function TenantsIndex({ tenants }: Props) {
    const getStatusColor = (status: string) => {
        switch (status) {
            case 'active': return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            case 'inactive': return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
            case 'suspended': return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
            default: return 'bg-gray-100 text-gray-800';
        }
    };

    return (
        <AppShell>
            <Head title="Tenant Management" />
            
            <div className="p-6">
                <div className="flex items-center justify-between mb-6">
                    <div>
                        <h1 className="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                            🏨 Tenant Management
                        </h1>
                        <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Manage hotel tenants and their configurations
                        </p>
                    </div>
                    <Link
                        href={route('tenants.create')}
                        className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        ➕ Add New Tenant
                    </Link>
                </div>

                {tenants.data.length === 0 ? (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">🏨</div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                            No tenants yet
                        </h3>
                        <p className="text-gray-500 dark:text-gray-400 mb-6">
                            Get started by creating your first hotel tenant.
                        </p>
                        <Link
                            href={route('tenants.create')}
                            className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                        >
                            Create First Tenant
                        </Link>
                    </div>
                ) : (
                    <div className="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
                        <ul className="divide-y divide-gray-200 dark:divide-gray-700">
                            {tenants.data.map((tenant) => (
                                <li key={tenant.id}>
                                    <Link
                                        href={route('tenants.show', tenant.id)}
                                        className="block px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                    >
                                        <div className="flex items-center justify-between">
                                            <div className="flex-1">
                                                <div className="flex items-center">
                                                    <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {tenant.name}
                                                    </h3>
                                                    <span className={`ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(tenant.status)}`}>
                                                        {tenant.status}
                                                    </span>
                                                </div>
                                                <div className="mt-2 flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                                    <span>🔗 {tenant.slug}</span>
                                                    {tenant.domain && <span>🌐 {tenant.domain}</span>}
                                                    <span>🗄️ {tenant.database_name}</span>
                                                    <span>📅 {new Date(tenant.created_at).toLocaleDateString()}</span>
                                                </div>
                                            </div>
                                            <div className="flex items-center space-x-2">
                                                <span className="text-2xl">🏨</span>
                                                <svg className="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>
                )}

                {/* Pagination */}
                {tenants.last_page > 1 && (
                    <div className="mt-6 flex items-center justify-between">
                        <div className="text-sm text-gray-500 dark:text-gray-400">
                            Showing {((tenants.current_page - 1) * tenants.per_page) + 1} to {Math.min(tenants.current_page * tenants.per_page, tenants.total)} of {tenants.total} tenants
                        </div>
                        <div className="flex space-x-1">
                            {/* Add pagination controls here if needed */}
                        </div>
                    </div>
                )}
            </div>
        </AppShell>
    );
}