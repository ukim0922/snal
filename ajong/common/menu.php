	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="top_login">
			<?php include "../common/top_login.php"; ?>
			</div>
			<div id="logo">
				<h1><a href="../common/index.php">SNAL</a></h1>
				<p>연세대학교 배드민턴 중앙동아리</p>
			</div>
					<div id="social">
						<ul class="contact">
							<li><a href="https://www.facebook.com/groups/1252207338123373/" class="icon icon-facebook"><span></span></a></li>
						</ul>
					</div>
		</div>
		<div id="menu" class="container">
			<ul>
			<?php
			if(isset($_SESSION['$current_page'])){
			switch($_SESSION['$current_page']){
				case 1:
					?>
					<li class="current_page_item"><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
					break;
				case 2:
					?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li class="current_page_item"><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
					break;
				case 3:
					?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li class="current_page_item"><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
					break;
				case 4:
					?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li class="current_page_item"><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
					break;
				case 5:
					?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li class="current_page_item"><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
					break;
				case 6:
					?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li class="current_page_item"><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
					break;
				default:
					?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<?php
			}
			}else {
			?>
					<li><a href="../common/index.php" accesskey="1" title="">About us</a></li>
					<li><a href="../notice/notice.php" accesskey="1" title="">Notice</a></li>
					<li><a href="../calendar/calendar.php" accesskey="2" title="">Calendar</a></li>
					<li><a href="../space/space.php" accesskey="3" title="">Space</a></li>
					<li><a href="../community/community.php" accesskey="4" title="">Community</a></li>
					<li><a href="../gallery/gallery.php" accesskey="4" title="">Gallery</a></li>
					<?php
			}
			?>
			</ul>
		</div>
	</div>