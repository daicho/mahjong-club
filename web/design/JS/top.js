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

    checkMember();
}

const checkMember = () => {
    let member = document.getElementsByClassName("name");

    let no = document.getElementsByClassName("emoji");
    let num = no.length;

    let hash;

    const emoji = { 0:'😀', 
                    1:'😃',
                    2:'😆',
                    3:'😅',
                    4:'🤣',
                    5:'🙃',
                    6:'😇',
                    7:'🥰',
                    8:'😍',
                    9:'🤬',
                    10:'👻',
                    11:'👺',
                    12:'👹',
                    13:'🤡',
                    14:'👽',
                    15:'👾',
                    16:'🤖',
                    17:'😤',
                    18:'😡',
                    19:'💀',
                    20:'😍',
                    21:'🤩',
                    22:'😘',
                    23:'😗',
                    24:'😚',
                    25:'😋',
                    26:'😛',
                    27:'😜',
                    28:'🤪',
                    30:'😝',
                    31:'🤑',
                    32:'🤗',
                    33:'🤭',
                    34:'🤫',
                    35:'🤔',
                    36:'🤐',
                    37:'🤨',
                    38:'😶',
                    39:'🙄',
                    40:'🤥',
                }

    for(let i = 0; i < num; i++)
    {
        hash = makeHash(member[i].textContent, member[i].textContent.length);
        console.log(hash);
        no[i].textContent = emoji[hash];
    }
}

const makeHash = (name, name_length) => {
    const weight = 16;
    const member_max = 41;


    let name_ascii = new Array(name_length);
    let hash = 0;
    let count = 0;

    for(let i = 0; i < name_length; i++)
    {
        name_ascii[i] = name.charCodeAt(i);
    }

    for(i = 0; i < name_length; i++)
    {
        hash += name_ascii[i] * (weight ** count);
        count += 1;
    }

    return hash % member_max;
}