PHP
��½��֤��

$query_data['user_token'] = 'rkmi2huqu9dv6750g5os11ilv2'; // ��ȡ��user_token
$query_data['mem_id'] = '23'; // ��ȡ���û�ID
$query_data['app_id'] = '1'; // ��ȡ����ϷAPPID
$app_key = 'de933fdbede098c62cb309443c3cf251'; // ��ȡ����ϷAPPKEY
$url = "https://sdkapi.5taogame.com/api/v7/cp/user/check";
$signstr = "app_id=" . $query_data['app_id'] . "&mem_id=" . $query_data['mem_id'] . "&user_token=" . $query_data['user_token'] . "&app_key=" . $app_key;
$query_data['sign'] = md5($signstr);
/* http���� */
$rdata = http_post_data($url, $query_data);
if ($rdata) {
    $rdata = json_decode($rdata,true);
    if ('1' == $rdata['status']) {
        // CP����,����ɹ�,�û���Ч
        echo $rdata['data'];
    }
}
// HTTP json����������
function http_post_data($url, array $query_data) {
    $post_str = http_build_query($query_data);
    $curl = curl_init(); // ��ʼ��curl
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0); // ����HTTPͷ
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ��ʾ������
    curl_setopt($curl, CURLOPT_POST, 1); // post��������
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_str); // post��������
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3); // ���õȴ�ʱ��
    $header = array(
        "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    //https ����
    if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $return_content = curl_exec($curl);
    curl_close($curl);
    return $return_content;
}
