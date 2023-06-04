import FormButton from "../../components/buttons/formButton";
import { PageSelectInput, TextAreaInput } from "../../components/inputs/pageInput";
import PageTitle from "../../components/typography/pageTitle";
import ViewText from "../../components/typography/viewText";
import PageContainer from "../../layouts/pageContainer";

const AddRecord = () => {
  const options = [
    {
    name: 'Hi',
    value: 1
  },
  {
    name: 'Hi',
    value: 1
  },
]

  const examLists = [ "Lids", "Conjunctiva", "Cornea", "AC", "Pupil", "Lens", "Vitreous", "Fundus", "Macula", "C/D"]
  const refractionList = [ "VA", "Lens", "Exit VA"]

  return ( 
    <>
    <PageContainer>
      <PageTitle title="New Client Record" />
      <form action="">
      <div className="grid grid-cols-12 gap-x-8">
        <div className="col-span-7 flex flex-col gap-y-4">
          <div className="grid grid-cols-3 gap-4">
          <ViewText label="Client Number" name="clientNumber" data={`ABC10-232324`} />
          <ViewText label="Client Name" name="clientName" data={`John Kuaw Doe`} />
          <ViewText label="Age" name="age" data={`24`} />
          
          </div>
          <div className="w-full">
          <TextAreaInput
                            label="Complaint"
                            placeholder="What is the client's complaint"
                            name="complaint"
                            id="complaint"
                            value=""
                            onchange={(event) => {}}
                        />
          </div>

           <div>
          <h5 className="text-primary font-semibold text-lg">ANTERIOR POSTERIOR EXAM</h5>
           
          {examLists.map((exam, index)  => (
          <div key={index} className="mt-1.5 grid grid-cols-5 gap-x-2">
          <div className="col-span-2">
          <PageSelectInput
                              
                              name={exam}
                              id={exam}
                              options={options}
                              value=''
                              onchange={(event) => { }}
                          />
          </div>
          <div className="col-span-1 place-self-center">
            <label htmlFor={exam} className="font-semibold ">{exam}</label>
          </div>
          <div className="col-span-2">
          <PageSelectInput
                              
                              name={exam}
                              id={exam}
                              options={options}
                              value=''
                              onchange={(event) => { }}
                          />
          </div>
        </div>
        ) )

        }
          
         

          </div>
         
          <div className="w-full">
          <TextAreaInput
                            label="Findings"
                            placeholder="What is your findings"
                            name="findings"
                            id="findings"
                            value=""
                            onchange={(event) => {}}
                        />
          </div>
          
        </div>
        <div className="col-span-5">
        <div>
          <h5 className="text-primary font-semibold text-lg">REFRACTION</h5>
           
          {refractionList.map((refraction, index)  => (
          <div key={index} className="mt-1.5 grid grid-cols-5 gap-x-2">
          <div className="col-span-2">
          <PageSelectInput
                              
                              name={refraction}
                              id={refraction}
                              options={options}
                              value=''
                              onchange={(event) => { }}
                          />
          </div>
          <div className="col-span-1 place-self-center">
            <label htmlFor={refraction} className="font-semibold ">{refraction}</label>
          </div>
          <div className="col-span-2">
          <PageSelectInput
                              
                              name={refraction}
                              id={refraction}
                              options={options}
                              value=''
                              onchange={(event) => { }}
                          />
          </div>
        </div>
        ) )

        }
          
          <div className=" mt-1.5 grid grid-cols-5 gap-x-4 items-center">
          <label htmlFor="specs" className="font-semibold ">Specs</label>
          <div className="col-span-4 w-full">
          <PageSelectInput
                              
                              name="specs"
                              id="specs"
                              options={options}
                              value=''
                              onchange={(event) => { }}
                          />
          </div>
        
          </div>

          </div>
          <div className="mt-4 w-full">
          <h5 className="text-primary font-semibold text-lg">PLAN</h5>
          <TextAreaInput
                            label="Impression"
                            placeholder="What is your impressions"
                            name="impression"
                            id="impression"
                            value=""
                            onchange={(event) => {}}
                        />
          </div>
          <div className="w-full">
          <TextAreaInput
                            label="Management"
                            placeholder="What is your management advice"
                            name="management"
                            id="management"
                            value=""
                            onchange={(event) => {}}
                        />
          </div>
          <div className="w-full">
          <TextAreaInput
                            label="Prescriptions"
                            placeholder="Enter Prescriptions"
                            name="prescriptions"
                            id="prescriptions"
                            value=""
                            onchange={(event) => {}}
                        />
          </div>
        </div>
      </div>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-x-8 py-6 w-full ">
                    <div className="col-start-3 w-ful  flex justify-end">
                        <FormButton cancelTo="/" />
                    </div>
                </div>
      </form>
    </PageContainer>
    </>
   );
}
 
export default AddRecord;