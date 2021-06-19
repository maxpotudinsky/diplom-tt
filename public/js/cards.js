// let projects = $('#projects');
//
// var refresh = setInterval(function (event) {
//     $.get('/projects/get', function (response) {
//         projects.html(response);
//         changeCards();
//     });
// }, 1000);
//
// function changeCards() {

// $('.js-cell-color').each(function () {
//
//     $('.js-cell-color').eq(0).addClass('card-secondary');
//     $('.js-cell-color').eq(1).addClass('card-primary');
//     $('.js-cell-color').eq(2).addClass('card-warning');
//     $('.js-cell-color').eq(3).addClass('card-success');
//
// });

$('.js-card').hover(function () {
        $(this).addClass('card-info');
    }, function () {
        $(this).removeClass('card-info');
    }
);

const cards = document.querySelectorAll('.js-card');
const cells = document.querySelectorAll('.js-cell');

let draggedCard = null;

for (let i = 0; i < cards.length; i++) {
    const card = cards[i];

    card.addEventListener('dragstart', function () {
        draggedCard = card;
        console.log('Карточка ' + draggedCard.id);
        setTimeout(function () {
            card.style.display = 'none';
        }, 0)
    });

    card.addEventListener('dragend', function () {
        setTimeout(function () {
            draggedCard.style.display = 'block';
            draggedCard = null;
        }, 0);
    })

    for (let j = 0; j < cells.length; j++) {
        const cell = cells[j];

        cell.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        cell.addEventListener('dragenter', function (e) {
            e.preventDefault();
            this.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
        });

        cell.addEventListener('dragleave', function (e) {
            this.style.backgroundColor = 'rgba(0, 0, 0, 0)';
        });

        cell.addEventListener('drop', function (e) {
            console.log('Колонка ' + cell.id);
            if (cell.id == 1) {
                draggedCard.className = 'card js-card card-outline card-secondary card-modal';
            }
            if (cell.id == 2) {
                draggedCard.className = 'card js-card card-outline card-primary card-modal';
            }
            if (cell.id == 3) {
                draggedCard.className = 'card js-card card-outline card-warning card-modal';
            }
            if (cell.id == 4) {
                draggedCard.className = 'card js-card card-outline card-success card-modal';
            }
            this.appendChild(draggedCard);
            this.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            $.ajax({
                type: 'POST',
                url: '/tasks/change',
                data: {taskId: draggedCard.id, statusId: cell.id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        });
    }
}
// }
