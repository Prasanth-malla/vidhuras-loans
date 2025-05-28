function calculateEMI(principal, rate, tenure) {
       const monthlyRate = rate / (12 * 100);
       const months = tenure * 12;
       const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) /
                   (Math.pow(1 + monthlyRate, months) - 1);
       return Math.round(emi);
     }