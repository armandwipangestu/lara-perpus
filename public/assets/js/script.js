const inputNumber = document.querySelectorAll('input[type="number"]');

if (inputNumber) {
    inputNumber.forEach((iN) => {
        iN.addEventListener("keypress", (event) => {
            if (
                (event.which != 8 && event.which != 0 && event.which < 48) ||
                event.which > 57
            ) {
                event.preventDefault();
            }
        });
    });
}

const signoutForm = document.querySelectorAll(".signoutForm");
signoutForm.forEach((sf) => {
    sf.addEventListener("click", (e) => {
        e.preventDefault();

        Notiflix.Confirm.show(
            "Confirmation Signout",
            "Are you sure?",
            "Yes",
            "No",
            function okCb() {
                sf.submit();
            },
            function cancelCb() {}
        );
    });
});

const previewImage = () => {
    const image = document.querySelector(".image-preview");
    const imgPreview = document.querySelector(".img-preview");

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = (oFREvent) => {
        imgPreview.src = oFREvent.target.result;
    };
};
