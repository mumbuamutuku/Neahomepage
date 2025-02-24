document.getElementById("commentForm").addEventListener("submit", async function(event) {
    event.preventDefault();

    let message = document.getElementById("message").value.trim();
    let blogId = "<?= $blogId ?>"; 

    if (!message) {
        alert("Please enter a comment.");
        return;
    }

    try {
        let response = await fetch(window.location.href, { 
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" }, 
            body: new URLSearchParams({ 'commentBody': message })
        });

        let data = await response.json();

        if (response.ok) {
            let commentsContainer = document.getElementById("commentsContainer");
            let newComment = `
                <div class="media mb-4 p-3 border-bottom">
                    <img src="${data.CommentWriterImage || 'default-user.png'}" class="me-3 rounded-circle border" style="width: 50px; height: 50px; object-fit: cover;">
                    <div class="media-body">
                        <h5 class="mb-1">${data.CommentWriterFirstName} ${data.CommentWriterLastName} 
                            <small class="text-muted"><i>Just now</i></small>
                        </h5>
                        <p class="text-muted">${message}</p>
                    </div>
                </div>`;

            commentsContainer.insertAdjacentHTML("afterbegin", newComment);
            document.getElementById("commentForm").reset();
        } else {
            alert("Failed to post comment.");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Sign up to post comment.");
    }
});
