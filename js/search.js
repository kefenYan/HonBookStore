// Book template for search result
// Stars from font-awesome
function bookTemplate(book) {      
    const starPercentage = book.rating * 100 / 5;
    return "<div class=\"hotsales\">" +
        "<a target=\"_blank\" href=./item.html?id=" + book.id 
        + "><img class=\"img\" src=" + book.imageUrl 
        + " width=\"600\" height=\"400\"></a><div class=\"desc\"><p>" 
        + book.title + "</p><p>$" + book.price 
        + "</p><div><div class=\"stars-outer\"><div class=\"stars-inner\" style=\"width:" 
        + starPercentage + "%;\"></div></div></div></div></div>"
}

// Initialize the books being searched
let books = [];

// Initialize the filtered books
let filteredBooks = books;

// Initialze the keyword and Filter variables
let keyword = "";
let priceFilter = {};
let ratingFilter = 0;
let sortOrder = 0;

window.onload = function() {
    // Initialize the books being searched
    books = [];

    // Initialize the filtered books
    filteredBooks = books;

    // Initialze the keyword and Filter variables
    keyword = "";
    priceFilter = {};
    ratingFilter = 0;
    sortOrder = 0;

    // Get the query string from URL
    let queryStr = window.location.search;
    // Store the parameters in a URLSearchParams Object
    let params = new URLSearchParams(queryStr);
    // Get keyword from URL parameters
    keyword = params.get("keyword");
    console.log(keyword);

    // If keyword is empty, return to home page. 
    if (!keyword) {
        window.location.href = "./Honbookstore.html";
        return;
    }

    let http = new XMLHttpRequest();
    // Pass keyword as GET request parameter to PHP
    http.open('GET', 'search.php?keyword=' + keyword);
    // callback: Get and display the books from PHP
    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            // Get the books if request succeeds
            books = JSON.parse(this.response);
            filteredBooks = books;
        } else {
            books = [];
        }
        displayBooks(books);
    };
    http.send();
}

// Sorting the books
function sortFunc() {
    let selectBox = document.getElementById("sort");
    // Get sorting option. 1 is for low to high. 2 is for high to low. 0 is for default
    sortOrder = selectBox.options[selectBox.selectedIndex].value;

    displayBooks(filteredBooks);
}

// Display the books
function displayBooks(books) {
    if (books.length == 0) {
        document.getElementById("searchInfo").innerHTML = "Couldn't find any books match keyword: " + keyword;
        return ;
    } 
    // Show the search query keyword on web page
    document.getElementById("searchInfo").innerHTML = "You are searchching: " + keyword;

    if (sortOrder == 1) {
        // Sorting the books by price from lowest to highest
        books.sort((book1, book2) => book1.price - book2.price);
    } else if (sortOrder == 2) {
        // Sorting the books by price from highest to lowest
        books.sort((book1, book2) => book2.price - book1.price);
    }


    // Reset the searbar
    document.getElementById("searchBar").innerHTML = "";

    // Display the books by applying bookTemplate to every books
    document.getElementById("displayResult").innerHTML = books.map(bookTemplate).join("");
}

// Get filter condition of price from HTML
function priceFunc(filter) {
    priceFilter = filter;
    filteredBooks = applyFilter(books);
    displayBooks(filteredBooks);
}

// Get filter condition of rating from HTML
function ratingFunc(filter) {
    ratingFilter = filter;
    filteredBooks = applyFilter(books);
    displayBooks(filteredBooks);
}

// Filter the books
function applyFilter(books) {
    return books.filter(book => {
        // Filter out the books with rating lower than rating range
        if (book.rating < ratingFilter) {
            return false;
        }

        // Filter out books with price lower than price range 
        if (priceFilter.low && book.price < priceFilter.low) {
            return false;
        }
        // Filter out books with price higher than price range 
        if (priceFilter.high && book.price > priceFilter.high) {
            return false;
        }

        return true;
    });
}