<?php 
session_start();
include "connect/conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>FixMyStreet</title>
</head>

<body>
    <div class="nav">
        <div class="navbar">
            <div class="navlogo">
                <h1><span class="span-tag">FixMy</span>Street</h1>
            </div>
            <div class="navitems">
                <li class="navlinks"><a href="" class="pac"><span class="span-1">Report a problem</span></a></li>
                


            <?php 
                if(isset($_SESSION['fullname'])) {
                    ?>
                    <li class="navlinks"><a href="form/signout.php" class="pac">Sign out (<?= $_SESSION['fullname'] ?>)</a></li>
                    <li class="navlinks"><a href="Pages/Dashboard.php" class="pac">Dashboard</a></li>
                    <?php
                } else{
                
                    ?>
                    <li class="navlinks"><a href="form/signin.php" class="pac">Sign in</a></li>
                <?php } ?>

               
                <li class="navlinks"><a href="Pages/all_Reports.php" class="pac"> All reports</a></li>
                <li class="navlinks"><a href="Pages/Local_alerts.php" class="pac">Local alerts</a></li>
                <li class="navlinks"><a href="Pages/help.php" class="pac">Help</a></li>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="content-container">
            <div class="banner">
                <div class="banner-content">
                    <h1 class="content-1">REPORT, VIEW, OR DISCUSS LOCAL PROBLEMS</h1>
                    <P class="para"> (like graffiti, fly tipping, broken paving
                        slabs or street lighting)</P>

                    <div class="button-submit"><a href="Pages/Dashboard.php">Submit reports</a></div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="card-content">
                wnfkjsnfdas
                fsfdsdfsadifjnf
                afssafbj
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis quae facere, magnam tenetur doloribus eos,
                quasi iste tempora porro facilis nemo officiis recusandae. Voluptatem labore eos sequi earum eveniet
                doloremque?
                
                
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, maxime in omnis similique repudiandae
                aliquam saepe. Quas voluptatibus consequuntur at enim ad praesentium harum saepe, perferendis quasi quaerat
                consequatur mollitia asperiores expedita odio quisquam magni eveniet beatae blanditiis suscipit labore
                tenetur optio nostrum nulla. Tempora laudantium, nisi doloremque obcaecati temporibus quidem dignissimos
                saepe et at voluptatem quisquam hic modi quibusdam facilis dolorum delectus consequuntur consectetur error
                sunt nesciunt rem recusandae neque magnam! Omnis totam culpa soluta nobis! Necessitatibus fugit odit quae
                praesentium illum dolorum quia sed consequatur amet nulla? Iste, tempora voluptate. Voluptate, laudantium
                nobis sapiente beatae dignissimos nisi ea. Modi id consequatur sint numquam quae deserunt! Veniam aperiam
                facere, beatae dignissimos voluptatum inventore ipsum, itaque magni temporibus vel quaerat atque, voluptates
                obcaecati saepe ducimus nam. Dignissimos illo repudiandae amet, numquam itaque doloremque provident delectus
                architecto facere earum reprehenderit qui, culpa ex consectetur adipisci enim ipsum magnam commodi odio.
                Nostrum esse nulla facere beatae qui fuga ducimus harum magni repellat, eum vero quaerat veniam veritatis
                deserunt omnis aut rerum ut suscipit voluptatum hic minima. Fugit distinctio maxime eveniet accusamus
                expedita illo quam, natus minus quas dolor provident atque blanditiis magni? Alias nihil ipsum mollitia
                commodi, accusantium possimus nisi, veritatis beatae officiis, quae laudantium rem distinctio nam
                consequuntur excepturi voluptatum animi. Quidem nihil sapiente asperiores? Quia odit magni repellat!
                Consequatur hic laudantium est quibusdam beatae error sunt ratione dolore non quo velit, architecto eum
                inventore optio eligendi aliquam laboriosam obcaecati. Fuga, illo. Culpa impedit, reiciendis laborum earum
                id reprehenderit architecto debitis porro dolor est nesciunt cupiditate libero temporibus. Nihil eveniet
                fugit fugiat corrupti hic illum consequuntur facere praesentium cumque, quam accusamus at rerum veritatis
                dolorem fuga molestias nobis enim porro quaerat. Consequatur quas dicta voluptates hic sit, id sequi
                molestias magnam illum error necessitatibus nisi atque nam veniam voluptatum ut, debitis ad, itaque culpa
                explicabo nesciunt commodi nostrum libero dolorem. Adipisci unde, eaque ipsum excepturi illo dolore.
                Expedita adipisci ipsam eos quod atque, quidem dolore? Blanditiis eligendi quibusdam autem tempora doloribus
                ab unde eos earum nobis repellendus veritatis aut iusto totam nesciunt nulla, est molestiae consectetur iste
                deserunt non ipsa dolores, aperiam doloremque vel. At ratione delectus distinctio sed sapiente aliquid vel
                quo? Consectetur unde atque aliquam, minima maxime cum non. Ad reprehenderit culpa velit, sit voluptates
                nihil dolor accusantium fuga. Natus eaque eius quos nostrum beatae dicta facilis minima, eligendi ipsum rem
                tempora saepe fuga necessitatibus numquam quisquam dignissimos accusantium temporibus repellendus? Aperiam
                neque nostrum placeat, laborum, vel dolores magni architecto earum provident expedita maxime eius aut!
                Tenetur pariatur tempore minus ad consequatur explicabo inventore id atque nemo velit at eveniet blanditiis
                dignissimos nostrum illo, dicta aut sed iste. Voluptatem quibusdam nisi tenetur sit. Sit iure perferendis
                accusantium corrupti dolor qui dignissimos. Repellat repudiandae iusto vel fugit aut molestias tempora neque
                atque quidem, optio doloribus facilis. Optio earum iste, odio totam, obcaecati pariatur aut nisi natus ex ad
                id praesentium temporibus error aspernatur illo saepe, nam officia ut libero eum? Libero illo saepe vel
                laboriosam tempore corrupti, aliquid repellat sunt?
            </div>

            <div class="cards">
                <div class="card-info">
                    <h1 class="card-title">For citizens</h1>
            
                    <p class="info">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse amet molestiae optio, nam
                        accusamus provident corrupti delectus natus modi doloremque? Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit. Optio itaque suscipit aperiam, dicta ea fuga, ducimus illo animi maiores enim
                        placeat libero dolorem! Doloremque quasi dignissimos numquam laudantium repellendus temporibus!</p>
                    <div class="card-button">
                        <a href="">Learn more</a>
                    </div>
                </div>
            
                <div class="card-info">
                    <h1 class="card-title">For citizens</h1>
            
                    <p class="info">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse amet molestiae optio, nam
                        accusamus provident corrupti delectus natus modi doloremque? Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit. Optio itaque suscipit aperiam, dicta ea fuga, ducimus illo animi maiores enim
                        placeat libero dolorem! Doloremque quasi dignissimos numquam laudantium repellendus temporibus!</p>
                    <div class="card-button">
                        <a href="">Learn more</a>
                    </div>
                </div>
            
                <div class="card-info">
                    <h1 class="card-title">For citizens</h1>
            
                    <p class="info">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse amet molestiae optio, nam
                        accusamus provident corrupti delectus natus modi doloremque? Lorem ipsum dolor, sit amet consectetur
                        adipisicing elit. Optio itaque suscipit aperiam, dicta ea fuga, ducimus illo animi maiores enim
                        placeat libero dolorem! Doloremque quasi dignissimos numquam laudantium repellendus temporibus!</p>
                    <div class="card-button">
                        <a href="">Learn more</a>
                    </div>
                </div>
            </div>
        </div>

        

      <div class="footer">
        <hr>
        <div class="inner-footer">
            <p class="footer-info">Lorem ipsum dolor sit amet.</p>
        </div>
      </div>

    </div>
</body>

</html>