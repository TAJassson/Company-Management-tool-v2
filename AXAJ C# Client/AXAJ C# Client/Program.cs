using System;
using System.IO;
using System.Management;
using System.Net;
using System.Net.Http;
using Newtonsoft;
using System.Web;
using System.Threading;
using System.Threading.Tasks;
using System.Text;
using Newtonsoft.Json;
using MySqlConnector;
using System.Net.NetworkInformation;

namespace AXAJ_C__Client
{
    internal class Program
    {
        private static Timer timer;
        static void Main(string[] args)
        {
            Console.WriteLine("Hello World!");
            timer = new Timer(async _ => await Core_POST_httpclient(), null, TimeSpan.Zero, TimeSpan.FromSeconds(20));

            Console.WriteLine("Press [Enter] to exit...");

            //GET_httpclient();
            Console.ReadLine();
        }
        
        private static string getdisk()
        {
            string userdisk = string.Empty;
            ObjectQuery diskgetname = new ObjectQuery("SELECT * FROM Win32_DiskDrive");
            ManagementObjectSearcher diskfinder = new ManagementObjectSearcher(diskgetname);
            foreach (ManagementObject wmi_HD in diskfinder.Get())
            {
                string diskname = $"{wmi_HD["Model"]} ";
                diskname = diskname.TrimEnd();
                userdisk += $"{diskname},";
            }
            return userdisk.TrimEnd(',');
        }
        private static string getdiskSN()
        {
            string userdisk = string.Empty;
            ObjectQuery diskgetname = new ObjectQuery("SELECT * FROM Win32_DiskDrive");
            ManagementObjectSearcher diskfinder = new ManagementObjectSearcher(diskgetname);
            foreach (ManagementObject wmi_HD in diskfinder.Get())
            {
                string diskname = $"{wmi_HD["SerialNumber"]} ";
                diskname = diskname.TrimEnd();
                userdisk += $"{diskname},";
            }
            return userdisk.TrimEnd(',');
        }
        private static string cpu()
        {
            string cpuModel = string.Empty;
            ManagementObjectSearcher cpuSearcher = new ManagementObjectSearcher("SELECT * FROM Win32_Processor");
            foreach (ManagementObject obj in cpuSearcher.Get())
            {
                cpuModel = obj["Name"].ToString();
                cpuModel = cpuModel.TrimEnd();  // Remove spaces from the CPU model
                break; // Assuming you only want to retrieve the model of the first CPU found
            }
            return cpuModel.TrimEnd(',');
        }
        private static string gpu()
        {
            string cpuModel = string.Empty;
            ManagementObjectSearcher cpuSearcher = new ManagementObjectSearcher("SELECT * FROM Win32_VideoController");
            foreach (ManagementObject obj in cpuSearcher.Get())
            {
                cpuModel = obj["Name"].ToString();
                cpuModel = cpuModel.TrimEnd();  // Remove spaces from the CPU model
                break; // Assuming you only want to retrieve the model of the first CPU found
            }
            return cpuModel.TrimEnd(',');
        }
        private static string mainboard()
        {
            string mbModel = string.Empty;
            ObjectQuery mb = new ObjectQuery("SELE" + "CT * FROM Win32_BaseBoard");
            ManagementObjectSearcher mbseacher = new ManagementObjectSearcher(mb);
            foreach (ManagementObject mbinfo in mbseacher.Get())
            {
                mbModel = mbinfo["Product"].ToString();
                mbModel = mbModel.TrimEnd();  // Remove spaces from the CPU model
                break; // Assuming you only want to retrieve the model of the first CPU found
            }
            return mbModel.TrimEnd(',');
        }
        private static string mainboardSN()
        {
            string mbSN = string.Empty;
            ObjectQuery mb = new ObjectQuery("SELE" + "CT * FROM Win32_BaseBoard");
            ManagementObjectSearcher mbseacher = new ManagementObjectSearcher(mb);
            foreach (ManagementObject mbinfo in mbseacher.Get())
            {
                mbSN = mbinfo["SerialNumber"].ToString();
                mbSN = mbSN.TrimEnd();  // Remove spaces from the CPU model
                break; // Assuming you only want to retrieve the model of the first CPU found
            }
            return mbSN.TrimEnd(',');
        }
        public static string GetRealIPAddress()
        {
            string externalIpString = new WebClient().DownloadString("http://icanhazip.com").Replace("\\r\\n", "").Replace("\n", "").Trim();
            IPAddress externalIp = IPAddress.Parse(externalIpString);
            return externalIp.ToString();
        }
          public static async Task POST_httpclient() // Async Upload HWID with JSON body to AJAX//
             {
                 string url = "http://ajax-hwid.neverless.xyz/interface/api/interface.php/hwid";

                 string Host = Dns.GetHostName();
                 string getDiskModel = getdisk();
                 string getcpu = cpu();
                 string getgpu = gpu();
                 string getMbModel = mainboard();
                 string getMBSN = mainboardSN();
                 string getDiskSN = getdiskSN();
                 string getIpAddress = GetRealIPAddress();
                 DateTime currentDate = DateTime.Now;
                 string formattedDate = currentDate.ToString("yyyy-MM-dd");

                 HttpClient client = new HttpClient();
                 string jsonBody = $"{{\"Hostname\":\"{Host}\",\"CPU\":\"{getcpu}\",\"GPU\":\"{getgpu}\",\"MB_model\":\"{getMbModel}\",\"MB_SN\":\"{getMBSN}\",\"DiskModel\":\"{getDiskModel}\",\"DiskSN\":\"{getDiskSN}\",\"IPAddress\":\"{getIpAddress}\",\"Date\":\"{formattedDate}\"}}";

                 var postData = new StringContent(jsonBody, Encoding.UTF8, "application/json");
                 HttpResponseMessage response = await client.PostAsync(url, postData);
                 string responseBody = await response.Content.ReadAsStringAsync();
                 Console.WriteLine(responseBody);

                 client.Dispose();
             }
        public static async Task Core_POST_httpclient() // Async Upload HWID with JSON body to AJAX
        {
            string server = "localhost";
            string database = "saint-gobain"; // Assuming the database name is saint-gobain
            string port = "3306";
            string username = "root"; // Replace 'your_username' with your actual MySQL username
            string connectionString = $"Server={server};Port={port};Database={database};Uid={username};";
            MySqlConnection connection = new MySqlConnection(connectionString);

            try
            {
                connection.Open();
                Console.WriteLine("Connected");
                string query = "SELECT p_id, p_name, p_category, p_cashpoint, p_stock, p_state,p_image FROM `product-info`"; // Enclose the table name within backticks
                MySqlCommand command = new MySqlCommand(query, connection);
                MySqlDataReader reader = command.ExecuteReader();

                using (HttpClient client = new HttpClient())
                {
                    Console.WriteLine("HttpClient");

                    while (reader.Read())
                    {
                        int p_id = reader.GetInt32("p_id");
                        string p_name = reader.GetString("p_name");
                        string p_category = reader.GetString("p_category");
                        int p_cashpoint = reader.GetInt32("p_cashpoint");
                        int p_stock = reader.GetInt32("p_stock");
                        string p_state = reader.GetString("p_state"); // Assuming p_state is coming from the database
                        string p_image = reader.GetString("p_image"); ; // You mentioned p_img, but it's not in the table

                        // Construct the API endpoint URL for GET request to check if p_id exists
                        string getUrl = $"http://26.199.184.39/API/Token/48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb/Interface.php/PL/GETPID/{p_id}";

                        HttpResponseMessage getResponse = await client.GetAsync(getUrl);
                        if (getResponse.IsSuccessStatusCode)
                        {
                            string getResponseBody = await getResponse.Content.ReadAsStringAsync();
                            if (getResponse.IsSuccessStatusCode && !string.IsNullOrEmpty(getResponseBody) && getResponseBody != "[]")
                            {
                                Console.WriteLine($"p_id {p_id} already exists. Skipping POST request.");
                                string PUT_url = "http://26.199.184.39/API/Token/48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb/Interface.php/PL";
                                string jsonBody_PUT = $"{{\"whs_name\":\"Saint-Gobain Hong Kong Limited\",\"whs_address\":\"7 Wang Lok Street, Yuen Long\",\"whs_token\":\"48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb\",\"p_id\":{p_id},\"p_name\":\"{p_name}\",\"p_stock\":{p_stock},\"p_img\":\"{p_image}\",\"p_cashpoint\":{p_cashpoint},\"p_state\":\"{p_state}\"}}";
                                var putData = new StringContent(jsonBody_PUT, Encoding.UTF8, "application/json");
                                HttpResponseMessage putResponse = await client.PutAsync(PUT_url, putData);
                                string putResponseBody = await putResponse.Content.ReadAsStringAsync();
                                Console.WriteLine(putResponseBody);
                                continue;
                            }
                        }

                        Console.WriteLine("POST");

                        // Construct the API endpoint URL with the retrieved data
                        string url = "http://26.199.184.39/API/Token/48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb/Interface.php/PL";
                        string jsonBody = $"{{\"whs_name\":\"Saint-Gobain Hong Kong Limited\",\"whs_address\":\"7 Wang Lok Street, Yuen Long\",\"whs_token\":\"48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb\",\"p_id\":{p_id},\"p_name\":\"{p_name}\",\"p_stock\":{p_stock},\"p_img\":\"{p_image}\",\"p_cashpoint\":{p_cashpoint},\"p_state\":\"{p_state}\"}}";

                        var postData = new StringContent(jsonBody, Encoding.UTF8, "application/json");

                        HttpResponseMessage postResponse = await client.PostAsync(url, postData);
                        string postResponseBody = await postResponse.Content.ReadAsStringAsync();
                        Console.WriteLine(postResponseBody);
                    }
                }

                reader.Close();
            }
            catch (MySqlException ex)
            {
                Console.WriteLine("Error: " + ex.Message);
            }
            finally
            {
                if (connection.State == System.Data.ConnectionState.Open)
                {
                    connection.Close();
                }
            }
        }
        public static async Task GET_httpclient()
        {
            HttpClient client = new HttpClient();
            string apiUrl = "http://ajax-apac-hwid.neverless.xyz/interface/api/interface.php/License/PCName/Testing";

            HttpResponseMessage response = await client.GetAsync(apiUrl);
            string responseBody = await response.Content.ReadAsStringAsync();
            //Encode JSON from Server
            var licenseList = JsonConvert.DeserializeObject<AJAX_CSS_License_Json_Decode[]>(responseBody);

            if (licenseList != null && licenseList.Length > 0)
            {
                var license = licenseList[0];
                if (license.License_Status == "1")
                {
                    Console.WriteLine("License status is 1");
                }
                else
                {
                    Console.WriteLine("License status is not 1.");
                }
            }
            else
            {
                Console.WriteLine("No license data found.");
            }

            client.Dispose();
        } // Async Get License from Server with JSON body//
    }
        class AJAX_CSS_License_Json_Decode
        {
            public string ClientID { get; set; }
            public string RecordID { get; set; }
            public string Hostname { get; set; }
            public string StartDate { get; set; }
            public string EndDate { get; set; }
            public string License_Status { get; set; }
            public string HWID_Hash { get; set; }
            public string IPAddress { get; set; }
        }
        class AJAX_CSS_Server_Token_Decode
    {
    }
        class AJAX_CSS_HwidServer_Decode
    {

    }
        class AJAX_CSS_HwidServer_HwidBan_Decode
    {

    }
        class AJAX_CSS_Admin_Master_Login
    {

    }
}

