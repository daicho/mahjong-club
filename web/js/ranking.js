const RankImg = new Array("svg/rank_frame.svg", "svg/rank_fill.svg");
const ManImg = new Array("svg/man_frame.svg", "svg/man_fill.svg");

let rank_block = document.getElementById("rank_block");
let member_block = document.getElementById("member_block");


const rankClick = () => {
    document.getElementById("man_img").src = ManImg[0];
    document.getElementById("rank_img").src = RankImg[1];

    member_block.style.display = "none";
    rank_block.style.display = "block";
}

const manClick = () => {
    document.getElementById("man_img").src = ManImg[1];
    document.getElementById("rank_img").src = RankImg[0];

    member_block.style.display = "block";
    rank_block.style.display = "none";
}
