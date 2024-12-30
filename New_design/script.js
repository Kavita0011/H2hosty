document.getElementById('insurance-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('fullName').value;
    const age = document.getElementById('age').value;
    const email = document.getElementById('email').value;

    if (name && age && email) {
        alert(`Thank you, ${name}. A quote has been sent to your email: ${email}`);
    } else {
        alert('Please fill all the fields.');
    }
});
window.addEventListener("scroll", function() {
    var navbar = document.querySelector(".nav");
    // Check the scroll position (distance from the top)
    if (window.scrollY > 500) { // Adjust this value based on when you want to show the navbar
        navbar.classList.add("visible");
    } else {
        navbar.classList.remove("visible");
    }
});

   // Toggle active state for income range
   const incomeOptions = document.querySelectorAll('.income .option');
   incomeOptions.forEach(option => {
     option.addEventListener('click', () => {
       incomeOptions.forEach(opt => opt.classList.remove('active'));
       option.classList.add('active');
     });
   });
// Function to switch between tabs
function showTab(tabId) {
    // Hide all tab content
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach(pane => {
        pane.classList.remove('active');
    });

    // Show the clicked tab's content
    const activeTab = document.getElementById(tabId);
    activeTab.classList.add('active');

    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });

    // Add active class to the clicked tab button
    const activeButton = Array.from(tabButtons).find(button => button.textContent.toLowerCase() === tabId);
    activeButton.classList.add('active');
}


// Function to toggle FAQ answer visibility
const faqQuestions = document.querySelectorAll('.faq-question');
faqQuestions.forEach(question => {
    question.addEventListener('click', function() {
        const answer = this.nextElementSibling;
        answer.classList.toggle('show');
    });
});
function toggleFAQ(button) {
    const answer = button.nextElementSibling;
    const isActive = button.classList.contains("active");

    // Close all open FAQs
    document.querySelectorAll(".faq-question").forEach((btn) => {
        btn.classList.remove("active");
        btn.nextElementSibling.style.display = "none";
    });

    // If not active, open the clicked FAQ
    if (!isActive) {
        button.classList.add("active");
        answer.style.display = "block";
    }
}
// Set the default tab to "insurance"
document.addEventListener('DOMContentLoaded', () => {
    showTab('insurance');
});
const viewMoreBtn = document.querySelector(".view-more");
const moreContent = document.querySelector(".more-content");

viewMoreBtn.addEventListener("click", function() {
    if (moreContent.style.display === "none" || moreContent.style.display === "") {
        moreContent.style.display = "block";
        viewMoreBtn.textContent = "View Less"; // Change button text
    } else {
        moreContent.style.display = "none";
        viewMoreBtn.textContent = "View More"; // Reset button text
    }
});