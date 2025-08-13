import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Hotel CMS - Multi-Tenant Content Management">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-gray-900 lg:justify-center lg:p-8 dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
                <header className="mb-6 w-full max-w-[335px] text-sm lg:max-w-6xl">
                    <nav className="flex items-center justify-end gap-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="inline-block rounded-lg bg-indigo-600 px-6 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-colors"
                            >
                                Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="inline-block rounded-lg border border-gray-300 px-5 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    Log in
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="inline-block rounded-lg bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-colors"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </header>

                <div className="flex w-full items-center justify-center lg:grow">
                    <main className="w-full max-w-6xl">
                        {/* Hero Section */}
                        <div className="text-center mb-12">
                            <div className="mb-6">
                                <span className="text-6xl">🏨</span>
                            </div>
                            <h1 className="text-4xl lg:text-6xl font-bold mb-6 bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                                Hotel CMS Platform
                            </h1>
                            <p className="text-xl lg:text-2xl text-gray-600 dark:text-gray-400 mb-8 max-w-3xl mx-auto">
                                Multi-tenant headless CMS tailored for hotel websites. Manage multiple properties with dedicated databases and custom domains.
                            </p>
                        </div>

                        {/* Features Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">🏢</div>
                                <h3 className="text-xl font-semibold mb-3">Multi-Tenant Architecture</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Each hotel gets its own isolated database, custom domain, and complete data separation for security and performance.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">📝</div>
                                <h3 className="text-xl font-semibold mb-3">Content Management</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Manage articles, hotel packages, image galleries, offers, and events with rich editing capabilities and SEO optimization.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">🔌</div>
                                <h3 className="text-xl font-semibold mb-3">Headless API</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    RESTful API endpoints for all content types, perfect for modern frontend frameworks and mobile applications.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">📦</div>
                                <h3 className="text-xl font-semibold mb-3">Hotel Packages</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Create hierarchical packages with sub-packages, pricing, features, and booking capabilities for complex hotel offerings.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">🖼️</div>
                                <h3 className="text-xl font-semibold mb-3">Media Management</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Advanced gallery system with slideshow capabilities, image optimization, and responsive delivery for all devices.
                                </p>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div className="text-3xl mb-4">🔐</div>
                                <h3 className="text-xl font-semibold mb-3">Role-Based Access</h3>
                                <p className="text-gray-600 dark:text-gray-400">
                                    Super admin controls all tenants, while tenant admins manage their hotel's content with granular permission systems.
                                </p>
                            </div>
                        </div>

                        {/* API Examples */}
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-200 dark:border-gray-700 mb-12">
                            <h2 className="text-2xl font-bold mb-6 flex items-center gap-3">
                                <span>🛠️</span> API Endpoints
                            </h2>
                            <div className="grid md:grid-cols-2 gap-6">
                                <div>
                                    <h3 className="font-semibold mb-3 text-indigo-600 dark:text-indigo-400">Content Endpoints</h3>
                                    <div className="space-y-2 text-sm font-mono bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <div>GET /api/v1/{`{hotel-slug}`}/articles</div>
                                        <div>GET /api/v1/{`{hotel-slug}`}/packages</div>
                                        <div>GET /api/v1/{`{hotel-slug}`}/galleries</div>
                                        <div>GET /api/v1/{`{hotel-slug}`}/offers</div>
                                        <div>GET /api/v1/{`{hotel-slug}`}/events</div>
                                    </div>
                                </div>
                                <div>
                                    <h3 className="font-semibold mb-3 text-indigo-600 dark:text-indigo-400">Features</h3>
                                    <ul className="space-y-2 text-sm">
                                        <li className="flex items-center gap-2">
                                            <span className="text-green-500">✓</span>
                                            Paginated responses
                                        </li>
                                        <li className="flex items-center gap-2">
                                            <span className="text-green-500">✓</span>
                                            SEO metadata included
                                        </li>
                                        <li className="flex items-center gap-2">
                                            <span className="text-green-500">✓</span>
                                            Image optimization
                                        </li>
                                        <li className="flex items-center gap-2">
                                            <span className="text-green-500">✓</span>
                                            Multi-language support
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {/* CTA Section */}
                        <div className="text-center bg-gradient-to-r from-indigo-600 to-blue-600 rounded-xl p-8 text-white">
                            <h2 className="text-2xl font-bold mb-4">Ready to Get Started?</h2>
                            <p className="text-lg opacity-90 mb-6">
                                Create your account and start managing multiple hotel websites from one powerful platform.
                            </p>
                            {!auth.user && (
                                <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                    <Link
                                        href={route('register')}
                                        className="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
                                    >
                                        Start Free Trial
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="inline-block border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition-colors"
                                    >
                                        Sign In
                                    </Link>
                                </div>
                            )}
                            {auth.user && (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
                                >
                                    Go to Dashboard
                                </Link>
                            )}
                        </div>

                        {/* Footer */}
                        <footer className="mt-12 text-center text-sm text-gray-500 dark:text-gray-400">
                            <p>Built with ❤️ using Laravel, React, and Inertia.js</p>
                        </footer>
                    </main>
                </div>
            </div>
        </>
    );
}