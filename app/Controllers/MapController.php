<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class MapController extends Controller
{
    public function showMap() {
         
        $database      = \Config\Database::connect();
        $queryBuilder = $database->table('user_locations');  
 
        $query = $queryBuilder->select('*')->limit(30)->get();
        $records = $query->getResult();
 
        $locationMarkers = [];
        $locInfo = [];
        $loc = [];
 
        foreach($records as $value) {
          $locationMarkers[] = [
            $value->location_name, $value->latitude, $value->longitude
          ];          
          $locInfo[] = [
           $value->location_name
          ];
          $loc[]=[$value->location_name];
        }
        $location['locationMarkers'] = json_encode($locationMarkers);
        $location['locInfo'] = json_encode($locInfo);
        $location['loc'] = json_encode($loc);
     
        return view('halPeta', $location);
    }
}