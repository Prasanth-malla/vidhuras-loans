    <?php
    // Simple PHP backend to serve the React app
    header('Content-Type: text/html; charset=UTF-8');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Vidhuras Loans - Your trusted partner for personalized loan and insurance solutions in Visakhapatnam.">
        <meta name="keywords" content="loans, insurance, home loan, business loan, personal loan, Vidhuras Loans, Visakhapatnam">
        <meta name="author" content="Vidhuras Loans">
        <title>Vidhuras Loans</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/react@18.2.0/umd/react.production.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/react-dom@18.2.0/umd/react-dom.production.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/babel-standalone@6.26.0/babel.min.js"></script>
        <script src="emi-calculator.js"></script>
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .hero-bg {
                background: linear-gradient(to right, rgba(30, 58, 138, 0.8), rgba(59, 130, 246, 0.8)), url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');
                background-size: cover;
                background-position: center;
                height: 600px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            html {
                scroll-behavior: smooth;
            }
            .navbar {
                transition: box-shadow 0.3s ease;
            }
            .navbar.scrolled {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .hamburger {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                width: 30px;
                height: 20px;
                cursor: pointer;
            }
            .hamburger div {
                width: 100%;
                height: 3px;
                background-color: #1e3a8a;
                transition: all 0.3s ease;
            }
            .hamburger.open div:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }
            .hamburger.open div:nth-child(2) {
                opacity: 0;
            }
            .hamburger.open div:nth-child(3) {
                transform: rotate(-45deg) translate(7px, -7px);
            }
            .nav-links {
                transition: all 0.3s ease;
            }
            .nav-links a {
                position: relative;
            }
            .nav-links a::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -2px;
                left: 0;
                background-color: #3b82f6;
                transition: width 0.3s ease;
            }
            .nav-links a:hover::after {
                width: 100%;
            }
            .social-icon {
                transition: transform 0.2s ease;
            }
            .social-icon:hover {
                transform: scale(1.2);
            }
            .emi-button, .chat-button {
                position: fixed;
                right: 20px;
                background-color: #3b82f6;
                color: white;
                padding: 15px;
                border-radius: 50%;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                cursor: pointer;
                z-index: 1000;
            }
            .emi-button {
                bottom: 20px;
            }
            .chat-button {
                bottom: 80px;
                background-color: #10b981;
            }
            .emi-popup, .chat-popup {
                position: fixed;
                right: 20px;
                width: 300px;
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                padding: 20px;
            }
            .emi-popup {
                bottom: 80px;
            }
            .chat-popup {
                bottom: 140px;
            }
            .emi-popup .close-btn, .chat-popup .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
                font-size: 20px;
                color: #1e3a8a;
            }
            .fade-in {
                animation: fadeIn 1s ease-in-out;
            }
            @keyframes fadeIn {
                0% { opacity: 0; }
                100% { opacity: 1; }
            }
            .faq-item {
                transition: all 0.3s ease;
            }
            .map-iframe {
                width: 100%;
                height: 300px;
                border: 0;
                border-radius: 8px;
            }
            .dropdown:hover .dropdown-menu {
                display: block;
            }
            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                z-index: 50;
            }
            .dropdown-menu a {
                display: block;
                padding: 10px 20px;
                color: #1e3a8a;
                text-align: left;
            }
            .dropdown-menu a:hover {
                background-color: #f3f4f6;
            }
            @media (max-width: 767px) {
                .dropdown-menu {
                    position: static;
                    box-shadow: none;
                }
                .dropdown:hover .dropdown-menu {
                    display: none;
                }
                .dropdown.open .dropdown-menu {
                    display: block;
                }
            }
            .comparison-table th, .comparison-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }
            .comparison-table th {
                background-color: #f3f4f6;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div id="root"></div>
        <script type="text/babel">
            function NavBar() {
                const [isOpen, setIsOpen] = React.useState(false);
                const [scrolled, setScrolled] = React.useState(false);
                const [dropdownOpen, setDropdownOpen] = React.useState(null);

                React.useEffect(() => {
                    const handleScroll = () => {
                        if (window.scrollY > 50) {
                            setScrolled(true);
                        } else {
                            setScrolled(false);
                        }
                    };
                    window.addEventListener('scroll', handleScroll);
                    return () => window.removeEventListener('scroll', handleScroll);
                }, []);

                const toggleDropdown = (menu) => {
                    setDropdownOpen(dropdownOpen === menu ? null : menu);
                };

                return (
                    <nav className={`bg-white sticky top-0 z-50 navbar ${scrolled ? 'scrolled' : ''}`} aria-label="Main navigation">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div className="flex justify-between items-center h-16">
                                <div className="flex items-center">
                                    <a href="#home" className="flex items-center">
                                        <img
    src="https://images.pexels.com/photos/669615/pexels-photo-669615.jpeg?auto=compress&cs=tinysrgb&w=100"
    alt="Vidhuras Loans Logo"
    className="h-10 w-10 rounded-full object-cover mr-2"
    onError={(e) => e.target.src = 'https://placehold.co/100?text=Logo'}
/>
                                        <h1 className="text-xl font-bold text-blue-900 hidden sm:block">Vidhuras Loans</h1>
                                    </a>
                                </div>
                                <div className="flex items-center space-x-4">
                                    <div className={`md:flex items-center space-x-6 nav-links ${isOpen ? 'block' : 'hidden'} md:block absolute md:static top-16 left-0 w-full bg-white md:bg-transparent p-4 md:p-0 shadow-md md:shadow-none`}>
                                        <a href="#home" className="block text-gray-700 hover:text-blue-600 px-3 py-2 font-medium" onClick={() => setIsOpen(false)}>Home</a>
                                        <a href="#about" className="block text-gray-700 hover:text-blue-600 px-3 py-2 font-medium" onClick={() => setIsOpen(false)}>About</a>
                                        <div className={`dropdown ${dropdownOpen === 'loans' ? 'open' : ''}`}>
                                            <button
                                                className="block text-gray-700 hover:text-blue-600 px-3 py-2 font-medium focus:outline-none"
                                                onClick={() => toggleDropdown('loans')}
                                                aria-haspopup="true"
                                                aria-expanded={dropdownOpen === 'loans'}
                                            >
                                                Loans ▼
                                            </button>
                                            <div className="dropdown-menu">
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Home Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Business Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Mortgage Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Personal Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Vehicle Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Education Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>MSME Loan</a>
                                                <a href="#loans" onClick={() => { setIsOpen(false); toggleDropdown('loans'); }}>Corporate Loan</a>
                                            </div>
                                        </div>
                                        <div className={`dropdown ${dropdownOpen === 'insurance' ? 'open' : ''}`}>
                                            <button
                                                className="block text-gray-700 hover:text-blue-600 px-3 py-2 font-medium focus:outline-none"
                                                onClick={() => toggleDropdown('insurance')}
                                                aria-haspopup="true"
                                                aria-expanded={dropdownOpen === 'insurance'}
                                            >
                                                Insurance ▼
                                            </button>
                                            <div className="dropdown-menu">
                                                <a href="#insurance" onClick={() => { setIsOpen(false); toggleDropdown('insurance'); }}>Health Insurance</a>
                                                <a href="#insurance" onClick={() => { setIsOpen(false); toggleDropdown('insurance'); }}>Life Insurance</a>
                                                <a href="#insurance" onClick={() => { setIsOpen(false); toggleDropdown('insurance'); }}>General Insurance</a>
                                            </div>
                                        </div>
                                        <a href="#contact" className="block text-gray-700 hover:text-blue-600 px-3 py-2 font-medium" onClick={() => setIsOpen(false)}>Contact Us</a>
                                        <a href="#contact" className="block bg-blue-600 text-white px-4 py-2 rounded-full font-medium hover:bg-blue-700 md:ml-4" onClick={() => setIsOpen(false)}>Quick Apply</a>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Visit our Facebook page" className="social-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 text-blue-600 hover:text-blue-800" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.563V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                            </svg>
                                        </a>
                                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="Visit our Twitter page" className="social-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 text-blue-400 hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-8.38 4.482A13.94 13.94 0 011.671 3.149a4.916 4.916 0 001.523 6.573 4.897 4.897 0 01-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 01-2.224.084 4.923 4.923 0 004.6 3.419A9.867 9.867 0 010 19.54a13.94 13.94 0 007.548 2.212c9.142 0 14.307-7.721 13.995-14.646A9.935 9.935 0 0024 4.557z"/>
                                            </svg>
                                        </a>
                                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Visit our Instagram page" className="social-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 text-pink-600 hover:text-pink-800" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.326 3.608 1.301.975.975 1.24 2.242 1.301 3.608.058 1.266.069 1.646.069 4.85s-.012 3.584-.07 4.85c-.062 1.366-.326 2.633-1.301 3.608-.975.975-2.242 1.24-3.608 1.301-1.266.058-1.646.069-4.85.069s-3.584-.012-4.85-.07c-1.366-.062-2.633-.326-3.608-1.301-.975-.975-1.24-2.242-1.301-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.326-2.633 1.301-3.608.975-.975 2.242-1.24 3.608-1.301C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.735 0 8.332.013 7.052.07 5.766.128 4.668.393 3.607 1.454 2.546 2.515 2.281 3.613 2.223 4.899 2.165 6.179 2.152 6.582 2.152 12s.013 5.418.07 6.698c.058 1.286.323 2.384 1.384 3.445 1.061 1.061 2.159 1.326 3.445 1.384 1.28.057 1.683.07 6.698.07s5.418-.013 6.698-.07c1.286-.058 2.384-.323 3.445-1.384 1.061-1.061 1.326-2.159 1.384-3.445.057-1.28.07-1.683.07-6.698s-.013-5.418-.07-6.698c-.058-1.286-.323-2.384-1.384-3.445-1.061-1.061-2.159-1.326-3.445-1.384C15.418.013 15.015 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                                            </svg>
                                        </a>
                                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="Visit our LinkedIn page" className="social-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 text-blue-700 hover:text-blue-900" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div className="flex items-center md:hidden">
                                        <button
                                            onClick={() => setIsOpen(!isOpen)}
                                            aria-label="Toggle menu"
                                            aria-expanded={isOpen}
                                            className="focus:outline-none"
                                        >
                                            <div className={`hamburger ${isOpen ? 'open' : ''}`}>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                );
            }

            function Hero() {
                return (
                    <section id="home" className="hero-bg text-white">
                        <div className="text-center">
                            <h2 className="text-5xl font-bold mb-4">Your Trusted Partner</h2>
                            <p className="text-xl mb-6">Experience personalized guidance and expert support every step of the way with Vidhuras Loans.</p>
                            <a href="#contact" className="bg-white text-blue-900 px-6 py-3 rounded-full font-semibold hover:bg-gray-200">Get Started</a>
                        </div>
                    </section>
                );
            }

            function Loans() {
                const loanTypes = [
                    { title: "Home Loan", desc: "Got my dream home easily with our quick home loan!", img: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "Business Loan", desc: "Fast business loan helped me grow my startup.", img: "https://images.unsplash.com/photo-1556157382-97eda2d62296?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "Personal Loan", desc: "Quick personal loan during my urgent need.", img: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "Vehicle Loan", desc: "Bought my car smoothly with our support.", img: "https://images.unsplash.com/photo-1583121274602-3e2820c69888?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "Education Loan", desc: "Easy education loan for my higher studies.", img: "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "MSME Loan", desc: "MSME loan boosted my small business growth.", img: "https://images.unsplash.com/photo-1556157382-97eda2d62296?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "Corporate Loan", desc: "Corporate loan made our expansion possible.", img: "https://images.unsplash.com/photo-1507679799987-c73779587ccf?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" },
                    { title: "Mortgage Loan", desc: "Smooth mortgage loan with expert guidance.", img: "https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" }
                ];

                const comparisonData = [
                    { type: "Home Loan", rate: "8.5%", tenure: "Up to 30 years", eligibility: "Age 21-65, Min. Income ₹5L/year" },
                    { type: "Business Loan", rate: "9.48%", tenure: "Up to 10 years", eligibility: "Business turnover ₹10L+, 3+ years in business" },
                    { type: "Mortgage Loan", rate: "9.0%", tenure: "Up to 15 years", eligibility: "Property ownership, Min. Income ₹3L/year" },
                    { type: "Personal Loan", rate: "9.99%", tenure: "Up to 5 years", eligibility: "Age 21-60, Min. Income ₹2L/year" },
                    { type: "Vehicle Loan", rate: "8.9%", tenure: "Up to 7 years", eligibility: "Age 21-65, Min. Income ₹2.5L/year" },
                    { type: "Education Loan", rate: "7.6%", tenure: "Up to 15 years", eligibility: "Admission to recognized institution" },
                    { type: "MSME Loan", rate: "8.0%", tenure: "Up to 10 years", eligibility: "MSME registration, Min. Turnover ₹10L/year" },
                    { type: "Corporate Loan", rate: "9.5%", tenure: "Up to 10 years", eligibility: "Corporate entity, Min. Turnover ₹50L/year" }
                ];

                return (
                    <section id="loans" className="py-16 bg-white">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">We Facilitate</h2>
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                                {loanTypes.map((loan, index) => (
                                    <div key={index} className="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                                        <img src={loan.img} alt={`${loan.title} illustration`} className="mx-auto mb-4 h-32 object-cover rounded-md" onError={(e) => e.target.src = 'https://placehold.co/400x200?text=Placeholder'} />
                                        <h3 className="text-xl font-semibold mb-2">{loan.title}</h3>
                                        <p>{loan.desc}</p>
                                        <a href="#contact" className="text-blue-600 hover:underline">Apply Now</a>
                                    </div>
                                ))}
                            </div>
                            <h3 className="text-2xl font-bold text-center text-blue-900 mb-6">Compare Our Loan Options</h3>
                            <div className="overflow-x-auto">
                                <table className="comparison-table w-full">
                                    <thead>
                                        <tr>
                                            <th>Loan Type</th>
                                            <th>Interest Rate</th>
                                            <th>Tenure</th>
                                            <th>Eligibility</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {comparisonData.map((loan, index) => (
                                            <tr key={index}>
                                                <td>{loan.type}</td>
                                                <td>{loan.rate}</td>
                                                <td>{loan.tenure}</td>
                                                <td>{loan.eligibility}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                );
            }

            function LoanEligibilityChecker() {
                const [loanType, setLoanType] = React.useState('');
                const [income, setIncome] = React.useState('');
                const [age, setAge] = React.useState('');
                const [result, setResult] = React.useState(null);

                const checkEligibility = () => {
                    if (!loanType || !income || !age) {
                        setResult('Please fill in all fields.');
                        return;
                    }

                    const annualIncome = Number(income);
                    const userAge = Number(age);

                    let eligible = false;
                    let message = '';

                    switch (loanType) {
                        case 'Home Loan':
                            eligible = annualIncome >= 500000 && userAge >= 21 && userAge <= 65;
                            message = eligible ? 'You are eligible for a Home Loan!' : 'Sorry, you do not meet the eligibility criteria for a Home Loan. (Min. Income: ₹5L/year, Age: 21-65)';
                            break;
                        case 'Business Loan':
                            eligible = annualIncome >= 1000000 && userAge >= 21 && userAge <= 65;
                            message = eligible ? 'You are eligible for a Business Loan!' : 'Sorry, you do not meet the eligibility criteria for a Business Loan. (Min. Turnover: ₹10L/year, Age: 21-65)';
                            break;
                        case 'Mortgage Loan':
                            eligible = annualIncome >= 300000 && userAge >= 21 && userAge <= 65;
                            message = eligible ? 'You are eligible for a Mortgage Loan!' : 'Sorry, you do not meet the eligibility criteria for a Mortgage Loan. (Min. Income: ₹3L/year, Age: 21-65)';
                            break;
                        case 'Personal Loan':
                            eligible = annualIncome >= 200000 && userAge >= 21 && userAge <= 60;
                            message = eligible ? 'You are eligible for a Personal Loan!' : 'Sorry, you do not meet the eligibility criteria for a Personal Loan. (Min. Income: ₹2L/year, Age: 21-60)';
                            break;
                        case 'Vehicle Loan':
                            eligible = annualIncome >= 250000 && userAge >= 21 && userAge <= 65;
                            message = eligible ? 'You are eligible for a Vehicle Loan!' : 'Sorry, you do not meet the eligibility criteria for a Vehicle Loan. (Min. Income: ₹2.5L/year, Age: 21-65)';
                            break;
                        case 'Education Loan':
                            eligible = userAge >= 18 && userAge <= 35;
                            message = eligible ? 'You are eligible for an Education Loan!' : 'Sorry, you do not meet the eligibility criteria for an Education Loan. (Age: 18-35)';
                            break;
                        case 'MSME Loan':
                            eligible = annualIncome >= 1000000 && userAge >= 21 && userAge <= 65;
                            message = eligible ? 'You are eligible for an MSME Loan!' : 'Sorry, you do not meet the eligibility criteria for an MSME Loan. (Min. Turnover: ₹10L/year, Age: 21-65)';
                            break;
                        case 'Corporate Loan':
                            eligible = annualIncome >= 5000000 && userAge >= 21 && userAge <= 65;
                            message = eligible ? 'You are eligible for a Corporate Loan!' : 'Sorry, you do not meet the eligibility criteria for a Corporate Loan. (Min. Turnover: ₹50L/year, Age: 21-65)';
                            break;
                        default:
                            message = 'Please select a valid loan type.';
                    }

                    setResult(message);
                };

                return (
                    <section className="py-16 bg-gray-50">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Check Your Loan Eligibility</h2>
                            <div className="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="loan-type">Loan Type</label>
                                    <select
                                        id="loan-type"
                                        className="w-full p-2 border rounded"
                                        value={loanType}
                                        onChange={(e) => setLoanType(e.target.value)}
                                        aria-label="Select loan type"
                                    >
                                        <option value="">Select a loan type</option>
                                        <option value="Home Loan">Home Loan</option>
                                        <option value="Business Loan">Business Loan</option>
                                        <option value="Mortgage Loan">Mortgage Loan</option>
                                        <option value="Personal Loan">Personal Loan</option>
                                        <option value="Vehicle Loan">Vehicle Loan</option>
                                        <option value="Education Loan">Education Loan</option>
                                        <option value="MSME Loan">MSME Loan</option>
                                        <option value="Corporate Loan">Corporate Loan</option>
                                    </select>
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="income">Annual Income (₹)</label>
                                    <input
                                        type="number"
                                        id="income"
                                        className="w-full p-2 border rounded"
                                        placeholder="Enter your annual income"
                                        value={income}
                                        onChange={(e) => setIncome(e.target.value)}
                                        aria-label="Annual income in rupees"
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="age">Age</label>
                                    <input
                                        type="number"
                                        id="age"
                                        className="w-full p-2 border rounded"
                                        placeholder="Enter your age"
                                        value={age}
                                        onChange={(e) => setAge(e.target.value)}
                                        aria-label="Your age"
                                    />
                                </div>
                                <button
                                    onClick={checkEligibility}
                                    className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                                    aria-label="Check loan eligibility"
                                >
                                    Check Eligibility
                                </button>
                                {result && (
                                    <div className="mt-4 text-center fade-in">
                                        <p className={`text-lg ${result.includes('eligible') ? 'text-green-600' : 'text-red-600'}`}>{result}</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </section>
                );
            }

            function InterestRates() {
                const [rates, setRates] = React.useState({
                    homeLoan: 8.5,
                    businessLoan: 12.0,
                    personalLoan: 10.5
                });

                React.useEffect(() => {
                    const interval = setInterval(() => {
                        setRates({
                            homeLoan: (8.5 + (Math.random() * 0.5 - 0.25)).toFixed(2),
                            businessLoan: (12.0 + (Math.random() * 0.5 - 0.25)).toFixed(2),
                            personalLoan: (10.5 + (Math.random() * 0.5 - 0.25)).toFixed(2)
                        });
                    }, 10000);
                    return () => clearInterval(interval);
                }, []);

                return (
                    <section className="py-16 bg-gray-50">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Current Interest Rates (Live)</h2>
                            <div className="grid grid-cols-1 sm:grid-cols-3 gap-8">
                                <div className="text-center fade-in">
                                    <h3 className="text-xl font-semibold mb-2">Home Loan</h3>
                                    <p className="text-2xl text-blue-600">{rates.homeLoan}%</p>
                                </div>
                                <div className="text-center fade-in">
                                    <h3 className="text-xl font-semibold mb-2">Business Loan</h3>
                                    <p className="text-2xl text-blue-600">{rates.businessLoan}%</p>
                                </div>
                                <div className="text-center fade-in">
                                    <h3 className="text-xl font-semibold mb-2">Personal Loan</h3>
                                    <p className="text-2xl text-blue-600">{rates.personalLoan}%</p>
                                </div>
                            </div>
                            <p className="text-center text-gray-500 mt-4">Rates update in real-time (simulated for demo).</p>
                        </div>
                    </section>
                );
            }

            function LoanApprovalCounter() {
                const [approvals, setApprovals] = React.useState(0);

                React.useEffect(() => {
                    const interval = setInterval(() => {
                        setApprovals((prev) => prev + 1);
                    }, 15000);
                    return () => clearInterval(interval);
                }, []);

                return (
                    <section className="py-16 bg-white">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Loan Approvals Today</h2>
                            <div className="text-center fade-in">
                                <p className="text-4xl font-bold text-blue-600">{approvals}</p>
                                <p className="text-gray-500 mt-2">Approvals and counting (simulated for demo)!</p>
                            </div>
                        </div>
                    </section>
                );
            }

            function LoanTracker() {
                const [applicationId, setApplicationId] = React.useState('');
                const [status, setStatus] = React.useState(null);

                const trackApplication = () => {
                    if (applicationId) {
                        const statuses = ['Processing', 'Under Review', 'Approved', 'Disbursed'];
                        const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
                        setStatus(randomStatus);
                        setTimeout(() => {
                            const newStatus = statuses[Math.min(statuses.indexOf(randomStatus) + 1, statuses.length - 1)];
                            setStatus(newStatus);
                        }, 5000);
                    } else {
                        setStatus(null);
                    }
                };

                return (
                    <section className="py-16 bg-white">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Track Your Loan Application</h2>
                            <div className="max-w-md mx-auto">
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="application-id">Application ID</label>
                                    <input
                                        type="text"
                                        id="application-id"
                                        value={applicationId}
                                        onChange={(e) => setApplicationId(e.target.value)}
                                        className="w-full p-2 border rounded"
                                        placeholder="Enter your application ID"
                                        aria-label="Loan application ID"
                                    />
                                </div>
                                <button
                                    onClick={trackApplication}
                                    className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                                    aria-label="Track loan application"
                                >
                                    Track Status
                                </button>
                                {status && (
                                    <div className="mt-4 text-center fade-in">
                                        <p className="text-lg font-semibold">Status: <span className="text-blue-600">{status}</span></p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </section>
                );
            }

            function LiveChatSupport() {
                const [isOpen, setIsOpen] = React.useState(false);
                const [message, setMessage] = React.useState('');
                const [response, setResponse] = React.useState('');

                const sendMessage = () => {
                    if (message) {
                        setResponse('Connecting to an agent...');
                        setTimeout(() => {
                            setResponse('Hello! Thanks for reaching out. How can I assist you today?');
                        }, 2000);
                    }
                };

                return (
                    <div>
                        <div className="chat-button" onClick={() => setIsOpen(true)} aria-label="Open Live Chat">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        {isOpen && (
                            <div className="chat-popup">
                                <span className="close-btn" onClick={() => setIsOpen(false)} aria-label="Close Live Chat">×</span>
                                <h3 className="text-xl font-bold text-blue-900 mb-4">Live Chat Support</h3>
                                <div className="mb-4">
                                    <textarea
                                        className="w-full p-2 border rounded"
                                        rows="3"
                                        placeholder="Type your message..."
                                        value={message}
                                        onChange={(e) => setMessage(e.target.value)}
                                        aria-label="Type your message"
                                    ></textarea>
                                </div>
                                <button
                                    onClick={sendMessage}
                                    className="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600"
                                    aria-label="Send message"
                                >
                                    Send
                                </button>
                                {response && (
                                    <div className="mt-4 p-2 bg-gray-100 rounded">
                                        <p className="text-gray-700">{response}</p>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                );
            }

            function Insurance() {
    const insuranceTypes = [
        { 
            title: "Health Insurance", 
            desc: "Secure medical needs with full health protection.", 
            img: "https://images.pexels.com/photos/3769151/pexels-photo-3769151.jpeg?auto=compress&cs=tinysrgb&w=400" 
        },
        { 
            title: "Life Insurance", 
            desc: "Protect your family's future with assured coverage.", 
            img: "https://images.pexels.com/photos/3760067/pexels-photo-3760067.jpeg?auto=compress&cs=tinysrgb&w=400" 
        },
        { 
            title: "General Insurance", 
            desc: "Cover your assets from risks, damage, or loss.", 
            img: "https://images.pexels.com/photos/5997209/pexels-photo-5997209.jpeg?auto=compress&cs=tinysrgb&w=400" 
        }
    ];

    return (
        <section id="insurance" className="py-16 bg-gray-50">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Insurance</h2>
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    {insuranceTypes.map((insurance, index) => (
                        <div key={index} className="bg-white p-6 rounded-lg shadow-md text-center">
                            <img 
                                src={insurance.img} 
                                alt={`${insurance.title} illustration`} 
                                className="mx-auto mb-4 h-32 object-cover rounded-md" 
                                onError={(e) => e.target.src = 'https://placehold.co/400x200?text=Placeholder'} 
                            />
                            <h3 className="text-xl font-semibold mb-2">{insurance.title}</h3>
                            <p>{insurance.desc}</p>
                            <a href="#contact" className="text-blue-600 hover:underline">Apply Now</a>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
            function EMICalculatorPopup() {
                const [isOpen, setIsOpen] = React.useState(false);
                const [principal, setPrincipal] = React.useState('');
                const [rate, setRate] = React.useState('');
                const [tenure, setTenure] = React.useState('');
                const [emi, setEmi] = React.useState(null);

                const calculate = () => {
                    if (principal && rate && tenure) {
                        const result = calculateEMI(Number(principal), Number(rate), Number(tenure));
                        setEmi(result);
                    } else {
                        setEmi(null);
                    }
                };

                React.useEffect(() => {
                    calculate();
                }, [principal, rate, tenure]);

                return (
                    <div>
                        <div className="emi-button" onClick={() => setIsOpen(true)} aria-label="Open EMI Calculator">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 7h6m0 0v6m0-6H5a2 2 0 00-2-2v6a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-4z" />
                            </svg>
                        </div>
                        {isOpen && (
                            <div className="emi-popup">
                                <span className="close-btn" onClick={() => setIsOpen(false)} aria-label="Close EMI Calculator">×</span>
                                <h3 className="text-xl font-bold text-blue-900 mb-4">EMI Calculator</h3>
                                <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Calculator icon" className="mx-auto mb-4 h-16 object-cover" onError={(e) => e.target.src = 'https://placehold.co/400x200?text=Placeholder'} />
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="principal">Loan Amount (₹)</label>
                                    <input
                                        type="number"
                                        id="principal"
                                        value={principal}
                                        onChange={(e) => setPrincipal(e.target.value)}
                                        className="w-full p-2 border rounded"
                                        placeholder="Enter loan amount"
                                        aria-label="Loan amount in rupees"
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="rate">Interest Rate (%)</label>
                                    <input
                                        type="number"
                                        id="rate"
                                        value={rate}
                                        onChange={(e) => setRate(e.target.value)}
                                        className="w-full p-2 border rounded"
                                        placeholder="Enter interest rate"
                                        aria-label="Annual interest rate"
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-gray-700 mb-2" htmlFor="tenure">Tenure (Years)</label>
                                    <input
                                        type="number"
                                        id="tenure"
                                        value={tenure}
                                        onChange={(e) => setTenure(e.target.value)}
                                        className="w-full p-2 border rounded"
                                        placeholder="Enter tenure in years"
                                        aria-label="Loan tenure in years"
                                    />
                                </div>
                                {emi && (
                                    <div className="mt-4 text-center">
                                        <p className="text-lg font-semibold">Monthly EMI: ₹{emi}</p>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                );
            }

            function ApplicationProcess() {
                return (
                    <section className="py-16 bg-white">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Fast & Easy Application Process</h2>
                            <div className="grid grid-cols-1 sm:grid-cols-3 gap-8">
                                <div className="text-center">
                                    <div className="text-4xl font-bold text-blue-600 mb-4">1</div>
                                    <h3 className="text-xl font-semibold mb-2">Choose Loan Amount</h3>
                                    <p>Select the loan amount that suits your needs and budget.</p>
                                </div>
                                <div className="text-center">
                                    <div className="text-4xl font-bold text-blue-600 mb-4">2</div>
                                    <h3 className="text-xl font-semibold mb-2">Approved Your Loan</h3>
                                    <p>Fast loan approval with minimal documents and zero hassle.</p>
                                </div>
                                <div className="text-center">
                                    <div className="text-4xl font-bold text-blue-600 mb-4">3</div>
                                    <h3 className="text-xl font-semibold mb-2">Get Your Cash</h3>
                                    <p>Get instant cash in your account with a quick and easy process.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                );
            }

            function Advantages() {
                const advantages = [
                    "Fast Approvals",
                    "Low Interest Rates",
                    "Tailored Financial Solutions",
                    "Personalized Guidance",
                    "Trustworthy Service",
                    "Convenient Availability",
                    "Supportive Atmosphere"
                ];

                return (
                    <section className="py-16 bg-gray-50">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Advantages of Vidhuras Loans</h2>
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                                {advantages.map((advantage, index) => (
                                    <div key={index} className="text-center text-gray-700 font-semibold">{advantage}</div>
                                ))}
                            </div>
                        </div>
                    </section>
                );
            }

            function About() {
                return (
                    <section id="about" className="py-16 bg-white">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Your Trusted Loan Experts</h2>
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                                <div>
                                    <div className="text-4xl font-bold text-blue-600 mb-4">10</div>
                                    <p>Years of Experience</p>
                                </div>
                                <div>
                                    <div className="text-4xl font-bold text-blue-600 mb-4">50</div>
                                    <p>Partner Banks & NBFCs</p>
                                </div>
                                <div>
                                    <div className="text-4xl font-bold text-blue-600 mb-4">20</div>
                                    <p>All over Andhra Pradesh and Telangana</p>
                                </div>
                                <div>
                                    <div className="text-4xl font-bold text-blue-600 mb-4">1000</div>
                                    <p>Successful Disbursal</p>
                                </div>
                            </div>
                        </div>
                    </section>
                );
            }

            function WhyChooseUs() {
                return (
                    <section className="py-16 bg-gray-50">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Why People Choose Us</h2>
                            <div className="grid grid-cols-1 sm:grid-cols-3 gap-8">
                                <div className="bg-white p-6 rounded-lg shadow-md">
                                    <h3 className="text-xl font-semibold mb-2">Personalized Financial Solutions</h3>
                                    <p>We offer customized loan options designed to meet your specific financial needs.</p>
                                </div>
                                <div className="bg-white p-6 rounded-lg shadow-md">
                                    <h3 className="text-xl font-semibold mb-2">Fast Approval, Low Interest</h3>
                                    <p>Quick loan approvals with low rates to save you time and money.</p>
                                </div>
                                <div className="bg-white p-6 rounded-lg shadow-md">
                                    <h3 className="text-xl font-semibold mb-2">Expert Loan Guidance</h3>
                                    <p>Get expert help and support through every step of the loan process.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                );
            }

            
            
        function Testimonials() {
    const testimonials = [
        { 
            name: "Ravi Kumar", 
            quote: "Vidhuras Loans made my home loan process seamless and fast!", 
            img: "https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=150" 
        },
        { 
            name: "Anita Sharma", 
            quote: "Their business loan helped my startup grow effortlessly.", 
            img: "https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=150" 
        },
        { 
            name: "Suresh Reddy", 
            quote: "Quick and reliable service for my car loan. Highly recommend!", 
            img: "https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=150" 
        },
        { 
            name: "Priya Menon", 
            quote: "The best loan service I’ve ever used. Highly professional!", 
            img: "https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg?auto=compress&cs=tinysrgb&w=150" 
        }
    ];

    const [currentIndex, setCurrentIndex] = React.useState(0);

    React.useEffect(() => {
        const interval = setInterval(() => {
            setCurrentIndex((prevIndex) => (prevIndex + 1) % testimonials.length);
        }, 5000);
        return () => clearInterval(interval);
    }, []);

    return (
        <section className="py-16 bg-white">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">What Our Customers Say</h2>
                <div className="max-w-md mx-auto fade-in">
                    <div className="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <img 
                            src={testimonials[currentIndex].img} 
                            alt={`Portrait of ${testimonials[currentIndex].name}`} 
                            className="mx-auto mb-4 h-16 w-16 rounded-full object-cover" 
                            onError={(e) => e.target.src = 'https://placehold.co/150?text=Placeholder'} 
                        />
                        <p className="italic mb-2">"{testimonials[currentIndex].quote}"</p>
                        <p className="font-semibold">{testimonials[currentIndex].name}</p>
                    </div>
                </div>
            </div>
        </section>
    );
}
            function FAQs() {
                const faqs = [
                    { q: "What types of loans do you offer?", a: "We offer Home, Business, Personal, Vehicle, Education, MSME, Corporate, and Mortgage loans." },
                    { q: "How fast is the loan approval process?", a: "Our process is designed for quick approvals, often within 24-48 hours." },
                    { q: "What are your interest rates?", a: "Interest rates vary based on loan type and eligibility. Contact us for details." },
                    { q: "What documents are required to apply for a loan?", a: "Basic documents include ID proof, address proof, income proof, and bank statements." },
                    { q: "Is there any processing fee?", a: "Processing fees may apply depending on the loan type. Please check with our team." },
                    { q: "Can I pre-close my loan early?", a: "Yes, most loans allow pre-closure with minimal or no penalties." }
                ];

                const [openIndex, setOpenIndex] = React.useState(null);
                const [lastUpdated, setLastUpdated] = React.useState(new Date().toLocaleTimeString());

                React.useEffect(() => {
                    const interval = setInterval(() => {
                        setLastUpdated(new Date().toLocaleTimeString());
                    }, 60000);
                    return () => clearInterval(interval);
                }, []);

                return (
                    <section id="faqs" className="py-16 bg-gray-50">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">FAQs</h2>
                            <div className="space-y-4">
                                {faqs.map((faq, index) => (
                                    <div key={index} className="faq-item bg-white p-4 rounded-lg shadow-md">
                                        <h3
                                            className="text-lg font-semibold cursor-pointer flex justify-between items-center"
                                            onClick={() => setOpenIndex(openIndex === index ? null : index)}
                                        >
                                            <span>{`${index + 1}. ${faq.q}`}</span>
                                            <span>{openIndex === index ? '−' : '+'}</span>
                                        </h3>
                                        {openIndex === index && (
                                            <p className="mt-2 fade-in">{faq.a}</p>
                                        )}
                                    </div>
                                ))}
                            </div>
                            <p className="text-center text-gray-500 mt-4">Last Updated: {lastUpdated}</p>
                        </div>
                    </section>
                );
            }

            function KnowledgeCentre() {
                const resources = [
                    "Latest tech news and updates",
                    "Expert-written articles and insights",
                    "Step-by-step how-to guides and tutorials",
                    "Downloadable resources like eBooks and templates",
                    "Interactive content: quizzes, webinars, and live sessions"
                ];

                return (
                    <section className="py-16 bg-white">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Vidhuras Loans Knowledge Centre</h2>
                            <ul className="list-disc list-inside space-y-2">
                                {resources.map((resource, index) => (
                                    <li key={index}>{resource}</li>
                                ))}
                            </ul>
                        </div>
                    </section>
                );
            }

        

            function Contact() {
    const [formData, setFormData] = React.useState({
        name: '',
        email: '',
        phone: ''
    });
    const [isSubmitted, setIsSubmitted] = React.useState(false);
    const [error, setError] = React.useState(null);

    const handleChange = (e) => {
        const { id, value } = e.target;
        setFormData((prev) => ({ ...prev, [id]: value }));
    };

    const handleSubmit = async () => {
        if (!formData.name || !formData.email || !formData.phone) {
            setError('Please fill in all fields.');
            return;
        }

        try {
            const webAppUrl = 'https://script.google.com/macros/s/AKfycby_MgStgeuOWg4vLWJBUeTxHV1PsKrWhY1otg17L7q1wtORpKYf-TTyp1SEG6OPdppcmA/exec'; // Update if new URL
            const response = await fetch(webAppUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: formData.name,
                    email: formData.email,
                    phone: formData.phone,
                    timestamp: new Date().toISOString()
                }),
                mode: 'cors'
            });

            const result = await response.json();

            if (response.ok && result.status === 'success') {
                setIsSubmitted(true);
                setFormData({ name: '', email: '', phone: '' });
                setError(null);
                setTimeout(() => setIsSubmitted(false), 3000);
            } else {
                throw new Error(result.message || 'Failed to submit form');
            }
        } catch (err) {
            setError(`Submission failed: ${err.message}`);
            console.error('Submission error:', err);
        }
    };

    return (
        <section id="contact" className="py-16 bg-gray-50">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 className="text-3xl font-bold text-center text-blue-900 mb-12">Contact Us</h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div className="text-center">
                        <h3 className="text-xl font-semibold mb-4">Get in Touch</h3>
                        <p className="mb-2">Botcha Square, Birla Junction, Visakhapatnam-530007.</p>
                        <p className="mb-2"><strong>Mail:</strong> vidhurasloansvizag@gmail.com</p>
                        <p className="mb-4"><strong>Phone:</strong> +91 8977701917 | +91 8977701918</p>
                        <div className="mb-4">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3800.436763324058!2d83.3028543148461!3d17.72614498786542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a394313b3b3c7d5%3A0x4b8c5e5e5e5e5e5e!2sBotcha%20Square%2C%20Birla%20Junction%2C%20Visakhapatnam%2C%20Andhra%20Pradesh%20530007!5e0!3m2!1sen!2sin!4v1698765432109!5m2!1sen!2sin"
                                className="map-iframe"
                                allowFullScreen=""
                                loading="lazy"
                                referrerPolicy="no-referrer-when-downgrade"
                                title="Vidhuras Loans Location Map"
                            ></iframe>
                        </div>
                        <a
                            href="https://wa.me/918977701917"
                            className="mt-4 inline-block bg-green-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-600"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Chat with us on WhatsApp
                        </a>
                    </div>
                    <div>
                        <h3 className="text-xl font-semibold mb-4 text-center">Send Us Your Details</h3>
                        <div className="bg-white p-6 rounded-lg shadow-md">
                            <div className="mb-4">
                                <label className="block text-gray-700 mb-2" htmlFor="name">Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    className="w-full p-2 border rounded"
                                    placeholder="Your name"
                                    aria-label="Your name"
                                    value={formData.name}
                                    onChange={handleChange}
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700 mb-2" htmlFor="email">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    className="w-full p-2 border rounded"
                                    placeholder="Your email"
                                    aria-label="Your email"
                                    value={formData.email}
                                    onChange={handleChange}
                                />
                            </div>
                            <div className="mb-4">
                                <label className="block text-gray-700 mb-2" htmlFor="phone">Phone Number</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    className="w-full p-2 border rounded"
                                    placeholder="Your phone number"
                                    aria-label="Your phone number"
                                    value={formData.phone}
                                    onChange={handleChange}
                                />
                            </div>
                            <button
                                onClick={handleSubmit}
                                className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                                aria-label="Submit contact form"
                            >
                                Submit
                            </button>
                            {isSubmitted && (
                                <div className="mt-4 text-center fade-in">
                                    <p className="text-green-600">Thank you! Your details have been sent.</p>
                                </div>
                            )}
                            {error && (
                                <div className="mt-4 text-center fade-in">
                                    <p className="text-red-600">{error}</p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

function Footer() {
                return (
                    <footer className="bg-blue-900 text-white py-6">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                            <p>© 2025 Vidhuras Loans — All Rights Reserved</p>
                        </div>
                    </footer>
                );
            }

            function App() {
                return (
                    <div>
                        <NavBar />
                        <Hero />
                        <Loans />
                        <LoanEligibilityChecker />
                        <InterestRates />
                        <LoanApprovalCounter />
                        <LoanTracker />
                        <Insurance />
                        <ApplicationProcess />
                        <Advantages />
                        <About />
                        <WhyChooseUs />
                        <Testimonials />
                        <FAQs />
                        <KnowledgeCentre />
                        <Contact />
                        <Footer />
                        <EMICalculatorPopup />
                        <LiveChatSupport />
                    </div>
                );
            }

            ReactDOM.render(<App />, document.getElementById('root'));
        </script>
    </body>
    </html>