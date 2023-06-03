import Chart from "chart.js/auto";
import { CategoryScale } from "chart.js";
import PageContainer from "../../layouts/pageContainer";
import PageTitle from "../../components/typography/pageTitle";
import { NavLink } from "react-router-dom";
import BarChart from "../../components/chart/barchart";
import { useState } from "react";

Chart.register(CategoryScale);

const Dashboard = () => {
  const quickLinks = [
    {
      name : 'Add New User',
      path : "users/new"
    },
    {
      name : 'Create New Role',
      path : "roles/new"
    },
  ]

  const [chartData, setChartData] = useState({
    labels: ['Jan ', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        
        datasets: [
            {
              label: 'Number of Client visits',
              data: [152, 101, 135, 91, 128, 166 ],
              backgroundColor:  '#4192FE',
              borderWidth: 1,
            }
        ]
  })
  return ( 
    <>
     <PageContainer>
     <PageTitle title="Dashboard"/>
     <div className="grid grid-cols-6 gap-4"> 
        <div className="col-span-4">
          <div>
            <BarChart chartData={chartData} />
          </div>
          <div className="mt-10 flex flex-col space-y-1">
              <h4 className="mb-1 text-xl font-semibold">Quick Actions</h4>
             { quickLinks.map((link, index) => {
              return (
              <NavLink to={link.path} className="text-primary hover:text-primary-100 font-semibold"  key={index}>{link.name} </NavLink>
              )

             })}
          </div>
        </div>
        <div className="col-span-2 flex flex-col space-y-3">
          <div className="w-full p-8 flex justify-between items-center bg-primary text-white"> 
            <span className="font-semibold text-xl"> Waiting List</span>
            <span className="text-4xl font-bold">4</span>
          </div>
          <div className="w-full p-8 flex justify-between items-center bg-blue-50 text-primary"> 
            <span className="font-semibold text-xl">visits</span>
            <div>
             <div className="text-4xl font-bold">25</div>
             <div className=" font-semibold text-xl">Today</div>
            </div>
            <div>
             <div className="text-4xl font-bold">54</div>
             <div className=" font-semibold text-xl">This Week</div>
            </div>
            
          </div>
          <div className="w-full p-8 flex justify-between items-center bg-blue-50 text-primary"> 
            <span className="font-semibold text-xl">New Clients</span>
            <div>
             <div className="text-4xl font-bold">11</div>
             <div className=" font-semibold text-xl">Today</div>
            </div>
            <div>
             <div className="text-4xl font-bold">21</div>
             <div className=" font-semibold text-xl">This Week</div>
            </div>
            
          </div>
          <div className="w-full p-8 flex justify-between items-center bg-blue-50 text-primary"> 
            <span className="font-semibold text-xl">Appointments</span>
            <div>
             <div className="text-4xl font-bold">7</div>
             <div className=" font-semibold text-xl">Today</div>
            </div>
           
            
          </div>
        </div>
     </div>
     </PageContainer>
    </>
   );
}
 
export default Dashboard;