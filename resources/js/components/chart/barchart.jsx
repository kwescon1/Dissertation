import { Bar } from "react-chartjs-2";

const BarChart = ({chartData}) => {
  return ( 
    <div>
      <Bar
        data={chartData}
        options={{
          plugins: {
            title: {
              display: false,
              text: "Client visits"
            },
            legend: {
              display: true
            }
          }
        }}
      />
    </div>
   );
}
 
export default BarChart;