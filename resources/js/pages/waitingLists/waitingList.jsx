import { useState } from "react";
import PageTitle from "../../components/typography/pageTitle";
import PageContainer from "../../layouts/pageContainer";
import moment from "moment";
import { Tab, Tabs } from "../../components/tabs/tab";
import { GiHamburgerMenu } from "react-icons/gi";
import { FaRegTrashAlt, FaRegFolderOpen } from "react-icons/fa";




const WaitingList = () => {
  let today = moment(new Date()).format('YYYY-MM-DD')
  const [date, setDate] = useState(today)

  const clients = [
    {
      name: 'Jone Doe',
      completed: false
    },
    {
      name: 'Ana Dray',
      completed: false
    },
    {
      name: 'Fella Mecaw',
      completed: true
    },
    {
      name: 'Max Allister',
      completed: true
    },
  ]

  return ( 
    <>
    <PageContainer>
      
      <PageTitle title="Waiting List" />
      <div className="flex flex-wrap justify-end">
        <input className="form-input" type="date" name="daye" id="date"  value={date} onChange={(event) => { setDate( moment( event.target.value ).format('YYYY-MM-DD'));  }}/>
      </div>
      <Tabs>
        <Tab label='In Queue'>
          <ul className="flex flex-col space-y-2 ">
          { clients.map((client, index) => {
              return ( !client.completed &&
              <li  key={index} className="flex flex-wrap justify-between rounded-md shadow-sm py-2 px-6 w-full bg-primary-5 text-primary">
                <div className="flex space-x-4 items-center">
                <GiHamburgerMenu  />
                <div className="font-semibold">{client.name} </div>
                 
                </div>
                <div className="flex space-x-4 items-center">
                  <FaRegFolderOpen  />
                <FaRegTrashAlt  />
                 
                </div>
                 </li>
              )

             })}
          </ul>
        </Tab>
        <Tab label='Completed'>
        <ul className="flex flex-col space-y-2 ">
          { clients.map((client, index) => {
              return (
                client.completed &&
              <li  key={index} className="flex flex-wrap justify-between rounded-md shadow-sm py-2 px-6 w-full bg-primary-5 text-primary">
                <div className="flex space-x-4 items-center">
                <div className="font-semibold">{client.name} </div>
                </div>
                <div className="flex space-x-4 items-center">
                </div>
                 </li>
              )

             })}
          </ul>
        </Tab>
      </Tabs>
    </PageContainer>
    </>
   );
}
 
export default WaitingList;