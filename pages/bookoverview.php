<?php 
    $pagetitle = 'Library';
    $page = 'bookoverview';
    require_once "../inc/head.php";
?>


<body  class="dark-academia">
    <div class="col text-center">
        <div id="bookList" class="row"></div>
    </div>
</body>

<?php 
    require_once '../inc/footer.php';
?>

<script>
    $(document).ready(function() {
        console.log("ready");

        $.get("../Classes_Functions/getbook.php", function(books) {
            $.each(books, function(index, book) {
                const div = $("<div>").addClass("col-md-2");
                const card = $("<div>").addClass("card").addClass("col-md-4").attr("style", "width: 18rem").attr("id", "bookCard");
                const cardBody = $("<div>").addClass("card-body");
                const image = $("<img>").attr("src", book.image).addClass("card-img-top");
                const title = $("<h5>").addClass("card-title").text(book.bookTitle);
                const author = $("<p>").addClass("card-text").text(book.authorName); 
                cardBody.append(image).append(title).append(author);
                card.append(cardBody);
                div.append(card);
                $("#bookList").append(card);
            });
        });
        

    }); 
</script>