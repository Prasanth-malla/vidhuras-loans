# Vidhuras Loans

**Your Trusted Partner for Personalized Loan and Insurance Solutions in Visakhapatnam**

A modern, responsive web application built with React, Tailwind CSS, and PHP backend for managing loans and insurance services. The platform provides an intuitive interface for customers to explore various loan products, check eligibility, calculate EMI, and connect with support.

---

## 🌟 Features

### Core Loan Services
- **8 Loan Types**: Home Loan, Business Loan, Personal Loan, Vehicle Loan, Education Loan, MSME Loan, Corporate Loan, and Mortgage Loan
- **3 Insurance Products**: Health Insurance, Life Insurance, and General Insurance

### Interactive Tools
- **EMI Calculator**: Real-time calculation of monthly EMI based on loan amount, interest rate, and tenure
- **Loan Eligibility Checker**: Instant eligibility assessment based on income and age
- **Application Tracker**: Track loan application status in real-time
- **Live Chat Support**: Connect with support agents instantly
- **Interest Rate Display**: Live (simulated) interest rate updates

### User Experience
- **Responsive Design**: Fully responsive across mobile, tablet, and desktop devices
- **Smooth Navigation**: Sticky navbar with dropdown menus for easy navigation
- **Dynamic Content**: Real-time counters, testimonial carousel, and animated transitions
- **Accessibility**: ARIA labels, semantic HTML, and keyboard-friendly navigation

### Additional Features
- **Comparison Table**: Side-by-side loan comparison with rates, tenure, and eligibility
- **Testimonials**: Customer success stories with auto-rotating carousel
- **FAQ Section**: Comprehensive frequently asked questions
- **Google Maps Integration**: Location display with embedded map
- **WhatsApp Integration**: Direct WhatsApp chat link
- **Contact Form**: Google Sheets integration for form submissions

---

## 🛠️ Technology Stack

- **Frontend**: 
  - React 18.2.0
  - Babel Standalone (JSX transformation)
  - Tailwind CSS (styling)
  
- **Backend**: 
  - PHP (header routing and HTML serving)
  - Google Apps Script (form submission handling)

- **Hosting**: PHP-based server
- **CDN**: Unsplash (images), Pexels (stock photos)

---

## 📁 File Structure

```
vidhuras-loans/
├── index.php                 # Main application file with React components
├── emi-calculator.js         # EMI calculation logic
├── README.md                 # Project documentation
└── [Additional files as needed]
```

---

## 🚀 Quick Start

### Prerequisites
- PHP 7.0 or higher
- Web server (Apache, Nginx, etc.)
- Modern web browser

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Prasanth-malla/vidhuras-loans.git
   cd vidhuras-loans
   ```

2. **Setup your web server**
   - Place the project files in your web server's root directory
   - For local development, use:
     ```bash
     php -S localhost:8000
     ```

3. **Access the application**
   - Open your browser and navigate to `http://localhost:8000`

---

## 📋 Component Overview

### Navigation & Layout
- **NavBar**: Sticky navigation with dropdown menus for Loans and Insurance
- **Hero**: Eye-catching banner with call-to-action
- **Footer**: Copyright and credits section

### Loan Components
- **Loans**: Grid display of 8 loan types with descriptions
- **LoanEligibilityChecker**: Form to check eligibility based on income and age
- **LoanTracker**: Track application status with application ID

### Financial Tools
- **EMICalculatorPopup**: Fixed popup button for quick EMI calculations
- **InterestRates**: Display of live (simulated) interest rates
- **LoanApprovalCounter**: Real-time approval counter (simulated)

### Insurance
- **Insurance**: Grid display of 3 insurance types (Health, Life, General)

### User Engagement
- **LiveChatSupport**: Fixed chat button with message functionality
- **Testimonials**: Auto-rotating customer testimonial carousel
- **FAQs**: Expandable FAQ section with latest update timestamp

### Information & Support
- **About**: Company statistics and credentials
- **WhyChooseUs**: Key differentiators
- **ApplicationProcess**: 3-step process explanation
- **Advantages**: Key benefits list
- **KnowledgeCentre**: Resource library overview
- **Contact**: Contact form with Google Sheets integration and location map

---

## ⚙️ Configuration

### Update Google Sheets Integration
To enable form submissions to Google Sheets:

1. Replace the `webAppUrl` in the `Contact` component with your Google Apps Script URL:
   ```javascript
   const webAppUrl = 'YOUR_GOOGLE_APPS_SCRIPT_URL';
   ```

2. Set up the corresponding Google Apps Script to handle POST requests

### Customize Company Details
Update the following in the code:
- Company address: "Botcha Square, Birra Junction, Visakhapatnam-530007"
- Email: vidhurasloansvizag@gmail.com
- Phone: +91 8977701917 | +91 8977701918
- WhatsApp link: https://wa.me/918977701917

### Modify Loan Data
Edit loan types, rates, tenure, and eligibility criteria in the respective component arrays (e.g., `loanTypes`, `comparisonData`)

---

## 📱 Responsive Breakpoints

- **Mobile**: < 640px (sm)
- **Tablet**: 640px - 1024px (md, lg)
- **Desktop**: > 1024px (lg, xl)

---

## 🔍 Key Features Explained

### EMI Calculator
- Calculates Monthly EMI using the formula: `EMI = P * R * (1+R)^N / ((1+R)^N - 1)`
- Requires: Principal amount, Annual interest rate, Tenure in years
- Updates automatically as user inputs values

### Eligibility Checker
- Validates income and age against loan-specific criteria
- Provides instant feedback with color-coded results
- Each loan type has unique eligibility requirements

### Live Chat
- Simulated chat experience with bot response
- Can be integrated with real chat services like Tawk.to or Zendesk

### Application Tracker
- Simulates loan application progression through stages
- Stages: Processing → Under Review → Approved → Disbursed

---

## 🎨 Customization

### Color Scheme
- Primary: Blue (#1e3a8a, #3b82f6)
- Secondary: Green (#10b981) for chat
- Backgrounds: Gray and white (#f3f4f6)

Modify in the `<style>` section of `index.php`

### Images
- Replace image URLs from Unsplash/Pexels with custom images
- Update the logo image path in NavBar component

---

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| Images not loading | Check image URLs, verify CDN access |
| Form not submitting | Verify Google Apps Script URL and CORS settings |
| Styling issues | Clear browser cache, check Tailwind CDN availability |
| Popup buttons not showing | Check z-index conflicts in CSS |

---

## 📈 Performance Optimization

- Uses CDN for React, Babel, and Tailwind CSS
- Minimal inline JavaScript
- Optimized image loading with error fallbacks
- Efficient state management with React hooks

---

## 🔒 Security Considerations

- Form data is sent to Google Apps Script with CORS enabled
- No sensitive data stored client-side
- All external links use `target="_blank"` with `rel="noopener noreferrer"`

---

## 📞 Contact & Support

- **Email**: vidhurasloansvizag@gmail.com
- **Phone**: +91 8977701917 | +91 8977701918
- **Location**: Botcha Square, Birra Junction, Visakhapatnam-530007
- **WhatsApp**: [Chat with us](https://wa.me/918977701917)

---

## 📄 License

© 2025 Vidhuras Loans — All Rights Reserved

---

## 👨‍💻 Developer

**Prasanth Malla**  
GitHub: [@Prasanth-malla](https://github.com/Prasanth-malla)

---

## 🙏 Acknowledgments

- React team for the excellent UI library
- Tailwind CSS for utility-first styling
- Unsplash and Pexels for free stock imagery
- Google Apps Script for backend automation

---

## 📝 Version History

**v1.0.0** (2025)
- Initial release
- 8 loan types with eligibility checker
- EMI calculator and application tracker
- Insurance products
- Live chat support
- Responsive design

---

**Last Updated**: April 9, 2025
