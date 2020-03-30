<?php

class PreviewProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity) {
        if ($entity == null) {
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        //TODO: ADD subtitle
        
        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden>
                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>

                            <div class='buttons'>
                                <button><img src='assets/images/play-white.png'>Play</button>
                                <button onclick='volumeToggle(this)'><img id='volumeMainPage' src='assets/images/volume-mute.png'></button>
                            </div>

                        </div>
                    </div>

                </div>";
        
    }

    private function getRandomEntity() {
        $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        return new Entity($this->con, $row);
    }
}

?>