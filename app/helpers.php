<?php
use  App\Models\NewClientMaster;
use  App\Models\LocationMaster;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


function getprocess()
{
      $process = NewClientMaster::join('client_master', 'client_master.client_id', '=', 'new_client_master.client_name')
                                  ->select('cm_id', 'account_head', 'dept_id', 'process', 'oh', 'qh', 'th','er_scop', 'sub_process', 'Stipend', 'StipendDays', 'client_id', 'client_master.client_name')->orderBy('client_master.client_name')->get();


     return $process;


}

function getlocation()
{
    $location  = LocationMaster::all();
    return  $location;
}



function customFunction($candidateNumber)
{
    $int_url  = 'https://interview.cogentems.com/interview/getRefData.php?type=1&param=' . $candidateNumber;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $int_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    $candidate = '';
    $candidate = json_decode($data);
    return $candidate;
}

function interviewDetails($candidateId)
{
    $int_url  = 'https://interview.cogentems.com/interview/getRefData.php?type=2&param=' . $candidateId;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $int_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    $candidateDetails = '';
    $candidateDetail = json_decode($data);
    return $candidateDetail;
}

function getDataByQuery($intId, $processOne, $createdOn)
{
    $sqlQuery = "select EmployeeID,case when INTID is null then
        'No'
        else 'Yes' end as 'Joined Y/N', ctc as 'Salary CTC', cm_id,case
        when
        df_id in (74,77,146, 147,148,149) then 'CSA' else 'Support' end
        as
        desig, case when emp_status='Active' then 'Yes' else 'No' end
        as
        'Current Active (Y/N)',location from (select
        p.EmployeeID,s.ctc,e.emp_status,e.df_id,e.cm_id,p.INTID,p.createdon,l1.location
        from personal_details p inner join salary_details s on
        s.EmployeeID=p.EmployeeID inner join employee_map e on
        e.EmployeeID=p.EmployeeID join location_master l1 on
        p.location=l1.id where emp_status='Active' and cast(p.createdon
        as
        date) >= cast('" . $createdOn . "' as date))t where
        INTID='" . $intId . "' and cm_id='" . $processOne . "'";

    $data = DB::select($sqlQuery);
    return $data;
}


function getPayDataByQuery($desig, $cmid, $createdOn)
{
    $sqlConnect = "select amount,1st_pay,2nd_pay,window_month from ref_amount_master where emp_type='" . $desig . "' and cm_id='" . $cmid . "' and (cast('" . $createdOn . "' as date) between ApplicableFrom and ApplicableTo)";
    $data = DB::select($sqlConnect);
    return $data;
}

function getData($EmployeeID)
{
    $sqlConnect = "select des_id from whole_details_peremp where EmployeeID='" . $EmployeeID . "'";
    $data = DB::select($sqlConnect);
    return $data;
}




