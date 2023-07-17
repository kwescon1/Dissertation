import { useState } from "react";
import PageTitle from "../../components/typography/pagetitle.jsx";
import ViewText from "../../components/typography/viewtext.jsx";
import PageContainer from "../../layouts/pageContainer.jsx";
import moment from "moment";
import PageInput, { PageSelectInput, TextAreaInput } from "../../components/inputs/pageinput.jsx";
import FormButton from "../../components/buttons/formbutton.jsx";


const AddAppointment = () => {
  const types = [
    {
      name: 'Check Up',
      value: 1
    },
    {
      name: 'Review',
      value: 2
    },
    {
      name: 'Change of Spectacle',
      value: 3
    },
  ]

  let today = moment(new Date()).format('YYYY-MM-DD')
  const [date, setDate] = useState(today)

  let theTime = moment(new Date().getTime()).format('HH:MM')
  const [time, setTime] = useState(theTime)

  return (
    <>
      <PageContainer>
        <PageTitle title="New Appointment" />
        <form>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
            <div className="space-y-4">
              <ViewText label="Client Name" name="clientName" data={`John Kuaw Doe`} />
              <ViewText label="Client Number" name="clientNumber" data={`ABC10-232324`} />
              <PageSelectInput
                label="Type"
                name="type"
                id="type"
                options={types}
                value={""}
                onchange={(event) => { }}
              />

              <PageInput
                label="Date"
                type="date"
                placeholder=""
                name="date"
                id="date"
                value={date}
                onchange={(event) => { setDate(moment(event.target.value).format('YYYY-MM-DD')); }}
              />
              <PageInput
                label="Time"
                type="time"
                placeholder=""
                name="time"
                id="time"
                value={time}
                onchange={(event) => { setTime(event.target.value) }}
              />
              <TextAreaInput
                label="Note"
                placeholder="Enter Appointment Notes"
                name="note"
                id="note"
                value=""
                onchange={(event) => { }}
              />
            </div>

            <div className="space-y-4">

            </div>

            <div className="space-y-4"></div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-x-8 py-6 w-full ">
            <div className="col-start-1 w-ful  flex justify-end">
              <FormButton cancelTo="/" />
            </div>
          </div>
        </form>
      </PageContainer>
    </>
  );
}

export default AddAppointment;