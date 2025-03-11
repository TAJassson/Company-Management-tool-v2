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
        private static async Task Core_POST_httpclient() // Async Upload HWID with JSON body to AJAX
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
                //SQL Query
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
                        string p_state = reader.GetString("p_state"); 
                        string p_image = reader.GetString("p_image"); ;

                        string getUrl = $"http://Server_Address/API/Token/48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb/Interface.php/PL/GETPID/{p_id}"; 
                        //RESETful api address
                        // http://<Server>/API/Token/<TokenID>/Interface.php/PL/GETPID/<YourPID>

                        HttpResponseMessage getResponse = await client.GetAsync(getUrl);
                        if (getResponse.IsSuccessStatusCode)
                        {
                            string getResponseBody = await getResponse.Content.ReadAsStringAsync();
                            if (getResponse.IsSuccessStatusCode && !string.IsNullOrEmpty(getResponseBody) && getResponseBody != "[]")
                            {
                                Console.WriteLine($"p_id {p_id} already exists. Skipping POST request.");
                                string PUT_url = "http://Server_Address/API/Token/48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb/Interface.php/PL";
                                //RESETful api address
                                // http://<Server>/API/Token/<TokenID>/Interface.php/PL/GETPID/PL//
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
                        string url = "http://Server_Address/API/Token/48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb/Interface.php/PL";
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

