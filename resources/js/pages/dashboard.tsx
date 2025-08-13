import { AppShell } from '@/components/app-shell';
import { Head, Link } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AppShell>
            <Head title="Dashboard" />
            
            <div className="p-6">
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                        🏨 Hotel CMS Dashboard
                    </h1>
                    <p className="text-gray-600 dark:text-gray-400">
                        Welcome to your multi-tenant hotel content management system
                    </p>
                </div>

                {/* Quick Stats */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">🏢</div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">Active Tenants</h3>
                                <p className="text-2xl font-bold text-indigo-600 dark:text-indigo-400">12</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">📝</div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Articles</h3>
                                <p className="text-2xl font-bold text-green-600 dark:text-green-400">248</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">📦</div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">Hotel Packages</h3>
                                <p className="text-2xl font-bold text-blue-600 dark:text-blue-400">89</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">🔌</div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">API Calls/Day</h3>
                                <p className="text-2xl font-bold text-purple-600 dark:text-purple-400">15.2K</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Main Actions */}
                <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <Link
                        href={route('tenants.index')}
                        className="bg-gradient-to-br from-indigo-500 to-blue-600 text-white rounded-xl p-6 hover:from-indigo-600 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                    >
                        <div className="text-4xl mb-3">🏢</div>
                        <h3 className="text-xl font-semibold mb-2">Manage Tenants</h3>
                        <p className="text-indigo-100">
                            Create, edit, and manage hotel tenants with isolated databases and custom domains.
                        </p>
                    </Link>

                    <div className="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-xl p-6 cursor-pointer hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <div className="text-4xl mb-3">📊</div>
                        <h3 className="text-xl font-semibold mb-2">Analytics</h3>
                        <p className="text-green-100">
                            Monitor API usage, content performance, and tenant activity across all properties.
                        </p>
                    </div>

                    <div className="bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-xl p-6 cursor-pointer hover:from-purple-600 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <div className="text-4xl mb-3">🔧</div>
                        <h3 className="text-xl font-semibold mb-2">System Settings</h3>
                        <p className="text-purple-100">
                            Configure global settings, API rate limits, and platform-wide configurations.
                        </p>
                    </div>
                </div>

                {/* API Documentation */}
                <div className="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border border-gray-200 dark:border-gray-700">
                    <h2 className="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100 flex items-center gap-3">
                        <span>🔌</span> API Documentation
                    </h2>
                    <p className="text-gray-600 dark:text-gray-400 mb-6">
                        Your headless CMS provides RESTful API endpoints for all content types. Perfect for modern frontend frameworks.
                    </p>
                    
                    <div className="grid md:grid-cols-2 gap-6">
                        <div>
                            <h3 className="font-semibold mb-3 text-indigo-600 dark:text-indigo-400">Example Endpoints</h3>
                            <div className="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 font-mono text-sm space-y-2">
                                <div className="text-green-600 dark:text-green-400">GET</div>
                                <div className="ml-4 text-gray-700 dark:text-gray-300">/api/v1/grand-hotel/articles</div>
                                <div className="ml-4 text-gray-700 dark:text-gray-300">/api/v1/grand-hotel/packages</div>
                                <div className="ml-4 text-gray-700 dark:text-gray-300">/api/v1/grand-hotel/galleries</div>
                                <div className="ml-4 text-gray-700 dark:text-gray-300">/api/v1/grand-hotel/offers</div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 className="font-semibold mb-3 text-indigo-600 dark:text-indigo-400">Response Features</h3>
                            <ul className="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                <li className="flex items-center gap-2">
                                    <span className="text-green-500">✓</span>
                                    JSON responses with full content data
                                </li>
                                <li className="flex items-center gap-2">
                                    <span className="text-green-500">✓</span>
                                    Pagination for large datasets
                                </li>
                                <li className="flex items-center gap-2">
                                    <span className="text-green-500">✓</span>
                                    SEO metadata included
                                </li>
                                <li className="flex items-center gap-2">
                                    <span className="text-green-500">✓</span>
                                    Image URLs optimized for web
                                </li>
                                <li className="flex items-center gap-2">
                                    <span className="text-green-500">✓</span>
                                    Hierarchical package structures
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div className="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <h4 className="font-semibold text-blue-900 dark:text-blue-100 mb-2">🚀 Getting Started</h4>
                        <p className="text-blue-800 dark:text-blue-200 text-sm">
                            All API endpoints are public and ready to use. No authentication required for reading content. 
                            Perfect for JAMstack sites, mobile apps, and modern web applications.
                        </p>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}