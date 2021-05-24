// let getTasks = function () {
//     $.ajax({
//         type: 'GET',
//         url: "/home/get",
//         success: function (msgs) {
//
//             // msgs.forEach(msg => console.log(msg));
//             msgs.forEach((msg) => {
//                 $('.ajaxCell').html(msg.id);
//                 console.log(msg.id);
//             });
//
//         },
//     });
// }
//
// if($('*').is('.ajaxCell')){
//     getTasks();
//     setInterval(getTasks, 1000);
// }

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

    for (let j = 0; j < cells.length; j ++) {
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
            this.append(draggedCard);
            this.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            $.ajax({
                type: 'POST',
                // url: "/tasks/" + draggedCard.id + "/edit/",
                url: "/tasks/upd/" + draggedCard.id + "/" + cell.id,
                // data: {cell: this.id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                // success: function () {
                //     $('#text').val('');
                //     getMessages();
                // }
            });
        });
    }
}
