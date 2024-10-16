<style>
    /* Sidebar styling */
.sidebar {
    width: 250px; /* Set the width of the sidebar */
    background-color: #333; /* Dark background for the sidebar */
    color: #fff; /* White text color */
    height: 100vh; /* Full height */
    padding: 20px; /* Padding around the sidebar */
    position: fixed; /* Fixed position */
    overflow-y: auto; /* Enable scrolling for overflow */
}

/* Sidebar heading */
.sidebar h1 {
    font-size: 24px; /* Font size for the heading */
    margin-bottom: 20px; /* Space below the heading */
    text-align: center; /* Center align the heading */
    color: #f39c12; /* Highlight color for the heading */
}

/* Navigation menu */
.nav-menu {
    margin-top: 20px; /* Space above the menu */
}

.nav-menu ul {
    list-style: none; /* Remove bullet points */
}

/* List item styling */
.nav-menu li {
    margin: 15px 0; /* Space between list items */
}

/* Link styling */
.nav-menu a {
    color: #bdc3c7; /* Light color for links */
    text-decoration: none; /* Remove underline */
    display: flex; /* Flexbox for alignment */
    align-items: center; /* Center vertically */
    padding: 10px; /* Padding around the links */
    border-radius: 5px; /* Rounded corners */
    transition: background 0.3s; /* Smooth background transition */
}

/* Active link styling */
.nav-menu a.active {
    background-color: #2980b9; /* Highlighted background for active link */
    color: white; /* White text for active link */
}

/* Link hover effect */
.nav-menu a:hover {
    background-color: #34495e; /* Darker background on hover */
    color: #ecf0f1; /* Light color for hover */
}

/* Dropdown menu */
.dropdown-menu {
    display: none; /* Hide dropdown by default */
    margin-top: 10px; /* Space above dropdown */
    padding-left: 20px; /* Indent dropdown items */
}

/* Show dropdown on hover */
.dropdown:hover .dropdown-menu {
    display: block; /* Display dropdown when hovered */
}

/* Button styling */
.logout-button {
    background-color: #e74c3c; /* Red background for logout button */
    color: white; /* White text color */
    border: none; /* No border */
    padding: 10px; /* Padding around the button */
    cursor: pointer; /* Pointer cursor on hover */
    width: 100%; /* Full width */
    margin-top: 20px; /* Space above the button */
    border-radius: 5px; /* Rounded corners */
    transition: background 0.3s; /* Smooth background transition */
}

/* Logout button hover effect */
.logout-button:hover {
    background-color: #c0392b; /* Darker red on hover */
}

/* Icon styling */
.nav-menu a i {
    margin-right: 10px; /* Space between icon and text */
}

/* Dropdown arrow icon */
.dropdown-toggle .fa-caret-down {
    margin-left: auto; /* Align dropdown arrow to the right */
}

</style>
<aside class="sidebar">
    <h1>Chilli's</h1>
    <nav class="nav-menu">
        <ul>
            <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-list"></i> Menus <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu content-area" id="contentArea">
                    <li><a href="#" id="loadFoods">Foods</a></li>
                    <li><a href="#" id="loadDrinks">Drinks</a></li>
                    <li><a href="#" id="loadDesserts">Desserts</a></li>
                    <li><a href="#" class="add-button"><i class="fas fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-star"></i> Reviews</a></li>
            <li><a href="#" id="loadFaq"><i class="fas fa-comments"></i> FAQ's</a></li> 
            <li><a href="#"><i class="fas fa-cogs"></i> Transaction History</a></li>
            <li><a href="#"><i class="fas fa-user"></i> User Accounts</a></li>
        </ul>  
    </nav>
    <button id="logoutButton" class="logout-button">
        <span class="icon"><i class="fas fa-sign-out-alt"></i></span> Log Out
    </button>
</aside>
