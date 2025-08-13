import React from 'react';
import { Head, useForm } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import InputError from '@/components/input-error';

interface TenantFormData {
    name: string;
    slug: string;
    domain: string;
    database_name: string;
    status: string;
    [key: string]: string;
}

export default function CreateTenant() {
    const { data, setData, post, processing, errors } = useForm<TenantFormData>({
        name: '',
        slug: '',
        domain: '',
        database_name: '',
        status: 'active'
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('tenants.store'));
    };

    const generateSlug = (name: string) => {
        return name
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-|-$/g, '');
    };

    const generateDatabaseName = (slug: string) => {
        return `hotel_${slug.replace(/-/g, '_')}`;
    };

    const handleNameChange = (name: string) => {
        const slug = generateSlug(name);
        const databaseName = generateDatabaseName(slug);
        
        setData(prevData => ({
            ...prevData,
            name,
            slug,
            database_name: databaseName
        }));
    };

    return (
        <AppShell>
            <Head title="Create New Tenant" />
            
            <div className="p-6">
                <div className="mb-6">
                    <h1 className="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                        🏨 Create New Tenant
                    </h1>
                    <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Add a new hotel to the multi-tenant CMS platform
                    </p>
                </div>

                <div className="max-w-2xl">
                    <div className="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <form onSubmit={handleSubmit} className="px-6 py-6 space-y-6">
                            <div>
                                <label htmlFor="name" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Hotel Name *
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    value={data.name}
                                    onChange={(e) => handleNameChange(e.target.value)}
                                    className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                    placeholder="Grand Hotel & Resort"
                                    required
                                />
                                <InputError message={errors.name} />
                            </div>

                            <div>
                                <label htmlFor="slug" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    URL Slug *
                                </label>
                                <div className="mt-1 flex rounded-md shadow-sm">
                                    <span className="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm dark:bg-gray-600 dark:border-gray-600 dark:text-gray-400">
                                        yourapp.com/
                                    </span>
                                    <input
                                        type="text"
                                        id="slug"
                                        value={data.slug}
                                        onChange={(e) => setData('slug', e.target.value)}
                                        className="block w-full flex-1 border-gray-300 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                        pattern="[a-z0-9-]+"
                                        title="Only lowercase letters, numbers, and hyphens allowed"
                                        required
                                    />
                                </div>
                                <p className="mt-1 text-sm text-gray-500">
                                    Only lowercase letters, numbers, and hyphens. Auto-generated from hotel name.
                                </p>
                                <InputError message={errors.slug} />
                            </div>

                            <div>
                                <label htmlFor="domain" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Custom Domain
                                </label>
                                <input
                                    type="text"
                                    id="domain"
                                    value={data.domain}
                                    onChange={(e) => setData('domain', e.target.value)}
                                    className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                    placeholder="grandhotel.com"
                                />
                                <p className="mt-1 text-sm text-gray-500">
                                    Optional. Leave empty to use subdomain.
                                </p>
                                <InputError message={errors.domain} />
                            </div>

                            <div>
                                <label htmlFor="database_name" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Database Name *
                                </label>
                                <input
                                    type="text"
                                    id="database_name"
                                    value={data.database_name}
                                    onChange={(e) => setData('database_name', e.target.value)}
                                    className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                    pattern="[a-z0-9_]+"
                                    title="Only lowercase letters, numbers, and underscores allowed"
                                    required
                                />
                                <p className="mt-1 text-sm text-gray-500">
                                    Database name for tenant isolation. Auto-generated from slug.
                                </p>
                                <InputError message={errors.database_name} />
                            </div>

                            <div>
                                <label htmlFor="status" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Status *
                                </label>
                                <select
                                    id="status"
                                    value={data.status}
                                    onChange={(e) => setData('status', e.target.value)}
                                    className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                    required
                                >
                                    <option value="active">🟢 Active</option>
                                    <option value="inactive">⚪ Inactive</option>
                                    <option value="suspended">🔴 Suspended</option>
                                </select>
                                <InputError message={errors.status} />
                            </div>

                            <div className="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={() => window.history.back()}
                                >
                                    Cancel
                                </Button>
                                <Button
                                    type="submit"
                                    disabled={processing}
                                    className="bg-indigo-600 hover:bg-indigo-700"
                                >
                                    {processing ? 'Creating...' : '✨ Create Tenant'}
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}