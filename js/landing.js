// Book list for popular books and hotsalebooks by getting the book id.
const popularBooks = [1, 2, 3, 4, 5];
const hotsalesBooks = [7, 9, 3, 2, 6];

// Book template for landing page
// Stars from font-awesome
function bookTemplate(book) {      
    const starPercentage = book.rating * 100 / 5;
    return "<div class=\"hotsales\">" +
        "<a target=\"_blank\" href=./item.html?id=" + book.id + "> <img class=\"img\" src=" 
        + book.imageUrl + " width=\"600\" height=\"400\"></a><div class=\"desc\"><p>" 
        + book.title + "</p><p>$" 
        + book.price + "</p><div><div class=\"stars-outer\"><div class=\"stars-inner\" style=\"width:" 
        + starPercentage + "%;\"></div></div></div></div></div>"
}

window.onload = function() {
    // Show the popular books
    requestBookInfo(popularBooks, (books) => {
        document.getElementById("popular").innerHTML = books.map(bookTemplate).join("");
    });    
    // Show the hotsale books
    requestBookInfo(hotsalesBooks, (books) => {
        document.getElementById("hotsales").innerHTML = books.map(bookTemplate).join("");
    });
}

function requestBookInfo(books, callback) {
    // Join the id of books into querystr
    let queryStr = books.join(',');
    let http = new XMLHttpRequest();
    // Pass queryStr as GET request parameter to PHP
    // For example, landing.php?ids=1,2,3,4,5
    http.open('GET', 'landing.php?ids=' + queryStr)
    // callback: Get the books from PHP
    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            // Run callback function if request succeeds
            books = JSON.parse(this.response)
            console.log(books)
            callback(books);
        } else {
            // Failed to get books
            books = [];
        }
    };
    http.send();
}