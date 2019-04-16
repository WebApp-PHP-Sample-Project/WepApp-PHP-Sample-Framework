<?php
  /**
   *
   */
  class SearchEngine
  {


    public function GetChecker($prf)
    {


      if (isset($_GET[$prf])) {
        return $_GET[$prf];
      }

      else {
        return "NO ENTRY";
      };
    }

    public function PostChecker($prf)
    {


      if (!empty($_POST[$prf])) {
        return $_POST[$prf];
      }

      else {
        return "NO ENTRY";
      };
    }

    public function PageValidation($pagename)
    {
      if ($pagename == "NO ENTRY") {
        return "page/Home.page.php";
      }
      else {
        return "page/" . $pagename . ".page.php";
      }
    }

    public function NameValidation($pagename)
    {
      if ($pagename == "NO ENTRY") {
        return "Home";
      }
      else {
        return $pagename;
      }
    }

    public function FileValidation($path)
    {
      $files = scandir($path);
      $count = count($files);
      //var_dump($count);

        $i = 0;

        $filelist = array('page' => array());
        foreach ($files as $file) {
          if ($file == "." || $file == "..") {
            continue;
          }
          elseif ($file == NULL) {
            die("Es ist ein Fehler aufgetreten!");
          }
          else {
            $filelist["page"][$i] = $path . $file;
          }
          $i++;
        }

      return $filelist;

    }



    public function SearchQuest($searchglobal, $link)
    {
      $words = explode(" ", $searchglobal);
      $wordlist = implode(", ", $words);
      $wordcheck = implode(" ", $words);
      $query = 'SELECT * FROM Generator WHERE ' .  $wordlist . ' LIKE ' . $wordcheck;

      //var_dump($query);



    }


    public function FormSearch($type, $name, $check, $link)
    {


      if ($check == "on") {
        $query = 'SELECT ' . $name . ' FROM ' . $type ;

        if ($result = mysqli_query($link, $query)) {

          /* fetch associative array */
          while ($obj = mysqli_fetch_array($result)) {
            $array_name = $obj[1];
            $array_link = $obj[2];
            $array_img = $obj[3];
            //var_dump($array_link);
            printf ("<figure class='product_galerie' > <a href='%s' target='_selfe'><img src=%s class='img_galerie' ><figcaption>%s</figcaption></a></figure>", $array_link, $array_img, $array_name);
          }

          /* free result set */
          mysqli_free_result($result);

        }
        mysqli_close($link);
      }


    }



  }



 ?>
