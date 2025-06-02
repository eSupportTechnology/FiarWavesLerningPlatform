@extends('frontend.master')

@section('title', 'Transfer Pathway - Edukon')

@section('content')

<style>
/* Hero Section */
.hero {
    background-image: url('assets/images/study.jpeg'); /* Replace with your image path */
    background-size: cover;
    background-position: center;
    height: 80vh; /* 70% of the viewport height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    animation: fadeInDown 1.5s ease-in-out;
}

.hero h1 {
    font-size: 2.8rem;
    margin-bottom: 10px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    animation: fadeInUp 1.5s ease-in-out;
    margin-top: 50px;
}

.content1 h3{
    font-size: 1.5rem;
    margin: 0;
    color:#1b2954;;
    margin-top: 100px;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-bottom: 50px;
    margin-top: 30px;   
}

/* Content Section */
.content1 {
    padding: 50px;
    max-width: 1300px;
    margin: 0 auto;
    font-size: 1.1rem;
    line-height: 1.7;
    color: rgba(0, 0, 0, 0.7);
    animation: fadeIn 1.5s ease-in-out;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-color: rgba(255, 248, 248, 0.7);
    background-position: center;
    margin-top: 80px;
}

.country-cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 20px 0;
    margin-top: 80px;
}

.card {
    background: white;
    border: 2px solid #ddd;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 350px;
    height: 250px;
    margin-left: 100px;

}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.card-link {
    text-decoration: none;
    color: inherit;
}

.card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card h3 {
    font-size: 1rem;
    padding: 20px;
    color: #333;
}
/* Contact Form Section */
.contact-form {
    background: rgba(38, 151, 243, 0.85);;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    max-width: 500px;
    margin: 40px auto;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transform: translateY(50px);
    transition: all 1s ease-in-out;
    margin-top: 100px;
}

.contact-form.visible {
    opacity: 1;
    transform: translateY(0);
    animation: fadeInUp 1.5s ease-in-out;
}

.contact-form h2 {
    font-size: 1.5rem;
    color:rgb(255, 255, 255);
    margin-bottom: 15px;
    
}

.contact-form label {
    display: block;
    font-size: 1rem;
    margin-bottom: 5px;
    color:rgb(255, 255, 255); ;
}

.contact-form input,
.contact-form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}

.contact-form button {
    background-color:rgb(0, 19, 100);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.contact-form button:hover {
    background-color:rgb(0, 18, 180);
}

/* Keyframes for Animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<!-- Hero Section -->
<section class="hero">
    <h1>Transfer Pathways</h1>
    
</section>

<!-- Content Section -->
<section class="content1">
<h3>Why Study in Sri Lanka and Transfer Abroad:<br> Unlocking Global Opportunities.</h3>
    <p> Studying abroad is a life-changing opportunity that opens doors to personal, academic, and professional
        growth. It allows you to immerse yourself in a new culture, explore diverse traditions, and gain a deeper
        understanding of the global community. Beyond the classroom, studying in a foreign country fosters independence,
        adaptability, and critical thinking—qualities highly valued by employers worldwide.
        When you study abroad, you gain access to world-class universities, state-of-the-art facilities, and internationally
        recognized degrees that elevate your academic qualifications. You also have the chance to learn from leading experts 
        in your field while engaging in innovative research and hands-on projects.</p>

    <p>Additionally, studying in a multicultural environment helps you develop strong communication skills and 
        build a global network of friends and professionals, which can enhance your career prospects. Whether 
        you’re looking to broaden your horizons, enhance your employability, or gain new perspectives on your 
        field of study, studying abroad equips you with the tools to succeed in an increasingly interconnected
        world.
        his journey isn’t just about earning a degree—it’s about discovering new opportunities, shaping your future,
        and becoming a truly global citizen. Take the leap and let studying abroad be the foundation for your personal
        and professional success!</p>
</section>

<div class="country-cards">
    <!-- Australia Card -->
    <div class="card">
        <a href="/australia-page" class="card-link">
            <img src="assets/images/australia.jpeg" alt="Australia Flag" class="card-img">
            <h3>Australia</h3>
        </a>
    </div>

    <!-- United Kingdom Card -->
    <div class="card">
        <a href="/uk-page" class="card-link">
            <img src="assets/images/uk.jpeg" alt="United Kingdom Flag" class="card-img">
            <h3>United Kingdom</h3>
        </a>
    </div>
</div>

<!-- Contact Form -->
<section class="contact-form hidden" id="contactForm">
    <h2>Get In Touch</h2>
    <form action="#" method="post">
        <label for="email">Enter your email address, one of our student consultants will reach out to you within 24 hours.</label>
        <input type="email" id="email" name="email" required>
        <label for="campus">Choose Campus</label>
        <select id="campus" name="campus" required>
            <option value="colombo">Colombo</option>
            <option value="kandy">Kandy</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</section>


<script>
// Scroll Animation for Form
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    
    window.addEventListener('scroll', () => {
        const formPosition = contactForm.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (formPosition < screenPosition) {
            contactForm.classList.add('visible');
        }
    });
});
</script>

@endsection        