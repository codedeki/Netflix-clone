<?php

class SeasonProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function create($entity) {
        $seasons = $entity->getSeasons();

        if (sizeof($seasons) == 0) {
            return;
        }

        $seasonsHtml = "";
        foreach ($seasons as $season) {
            $seasonNumber = $season->getSeasonNumber();

            $videosHtml = "";
            foreach ($season->getVideos() as $video) {
                $videosHtml .= $this->createVideoCard($video);
            }

            $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                <div class='videos'>
                                    $videosHtml
                                </div>
                            </div>";
        }

        return $seasonsHtml;
    }

    private function createVideoCard($video) {
        $id = $video->getId();
        $thumbnail = $video->getThumbnail();
        $name = $video->getTitle();
        $description = $video->getDescription();
        $episodeNumber = $video->getEpisodeNumber();
        $hasSeen = $video->hasSeen($this->username) ? "<img class='seen' src='assets/images/checked.png'>" : "";

        return "<a href='watch.php?id=$id'>
                    <div class='episodeContainer'>
                        <div class='contents'>
                            <img class='imageContainer' src='$thumbnail'>
                            
                            <div class='videoInfo'>
                                <h4>$episodeNumber . $name</h4>
                                <span>$description</span>
                            </div>

                            $hasSeen

                        </div>
                    </div>
                </a>";
    }
}

?>