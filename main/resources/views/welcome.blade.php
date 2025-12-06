<style>
/* --- 1. Global Reset & Header Base --- */
.main-header {
    background-color: #ffffff; /* White background */
    border-bottom: 1px solid #eeeeee; /* Light separator line */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Soft shadow */
    width: 100%;
    position: sticky; /* Keeps header visible on scroll */
    top: 0;
    z-index: 1000;
}

.header-container {
    max-width: 1200px; /* Max width for content */
    margin: 0 auto;
    padding: 10px 20px;
    display: flex; /* Enables Flexbox */
    justify-content: space-between; /* Puts space between logo and menu */
    align-items: center;
}

/* --- 2. Logo Styling --- */
.logo {
    font-size: 1.5rem; /* Large and clear */
    font-weight: 700;
    color: #3498db; /* Brand Color */
    text-decoration: none;
    padding: 5px 0;
}

/* --- 3. Navigation Styling (Desktop) --- */
.nav-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex; /* Horizontal alignment for links */
    gap: 25px; /* Space between links */
}

.nav-menu ul li a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    padding: 10px 0;
    transition: color 0.3s;
}

.nav-menu ul li a:hover {
    color: #2980b9; /* Darker shade on hover */
}

/* Call To Action (CTA) Link Styling */
.nav-menu ul li.cta a {
    background-color: #3498db;
    color: #ffffff;
    padding: 8px 15px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.nav-menu ul li.cta a:hover {
    background-color: #2980b9;
}

/* --- 4. Mobile Toggle Icon (Hidden on Desktop) --- */
.menu-toggle {
    display: none; /* Hide the hamburger icon by default on desktop */
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    font-size: 1.5rem;
    line-height: 1;
}

/* Simple style for the hamburger icon */
.menu-toggle::before {
    content: "☰"; 
    color: #333;
}


/* --- 5. Responsiveness (Mobile View) --- */
@media (max-width: 768px) {
    /* Show the hamburger menu icon */
    .menu-toggle {
        display: block;
    }

    /* Hide the navigation list on mobile */
    .nav-menu {
        /* When activated by JS, this menu will typically slide down or overlay */
        display: none; 
    }
}
</style>
<header class="main-header">
    <div class="header-container">
        <a class="logo">
            SHOP
        </a>

        <nav class="nav-menu">
            <ul>
                <li><a href="/products">Products</a></li>
                <li><a href="/orders">Orders</a></li>
            </ul>
        </nav>

        <button class="menu-toggle" aria-label="Toggle navigation">
            <span class="hamburger"></span>
        </button>
    </div>
</header>