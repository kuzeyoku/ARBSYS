// dynamicRules.js
const dynamicRulesConfig = {
    // Agreement Document
    "agreement_document": {
      "side_ids[]": { required: true },
      "soother_center_name": { required: false },
    },
  
    // Arbiter Define Protocol
    "arbiter_define_protocol": {
      "side_ids[]": { required: true },
      "arbiter_define_protocol_answer": { required: true },
      "arbiter_tc": { required: true },
      "arbiter_name": { required: true },
    },
  
    // Arbiter Process Info Protocol
    "arbiter_process_info_protocol": {
      "side_ids[]": { required: true },
      "meeting_date": { required: true },
      "meeting_address": { required: true },
      "mediation_center_id": { required: true },
    },
  
    // Authority Document
    "authority_document": {
      "side_ids[]": { required: true },
      "meeting_date": { required: true },
      "meeting_hour": { required: true },
    },
  
    // Authority Objection
    "authority_objection": {
      "side_ids[]": { required: true },
      "work_name": { required: true },
      "work_time": { required: true },
      "chamber_of_commerce": { required: true },
      "date": { required: true },
      "number": { required: true },
      "page": { required: true },
    },
  
    // Final Protocol
    "final_protocol": {
      "side_ids[]": { required: true },
      "mediation_center": { required: false },
      "result_type_id": { required: true },
      "meeting_not_join": { required: true },
      "suggested_solution": { required: true },
      "session_count": { required: true },
      "session_time": { required: true },
    },
  
    // Invitation Letter
    "invitation_letter": {
      "side_ids[]": { required: true },
      "meeting_date": { required: true },
      "meeting_start_hour": { required: true },
      "mediation_center": { required: false },
      "meeting_address": { required: true },
      "want_write": { required: true },
    },
  
    // KVKK
    "kvkk": {
      "side_ids[]": { required: true },
      "meeting_date": { required: true },
      "meeting_address": { required: true },
      "mediation_center_id": { required: true },
    },

    // Wage Agreement
    "wage_agreement": {
        "side_ids[]": { required: true },
        "wage_type": { required: true },
        "money": { required: true },
        "hour": { required: true },
        "price": { required: true },
      },

      // Lawsuit
      "lawsuit": {
        "side_ids[]": { required: true },
        "delivery_by": { required: true },
        "lawsuit_type_id": { required: true },
        "lawsuit_subject_id": { required: true },
        "lawsuit_subject_type_id": { required: true },
        "application_document_no": { required: true },
        "mediation_document_no": { required: true },
        "job_date": { required: true },
        "application_date": { required: true },
        "process_start_date": { required: true },
        "result_type_id": { required: true },
        "result_date": { required: true },
        "mediation_office": { required: true },
      },

      // Edit Wizard
      "edit_lawsuit": {
        "side_ids[]": { required: true },
        "delivery_by": { required: true },
        "lawsuit_type_id": { required: true },
        "lawsuit_subject_id": { required: true },
        "firm_document_no": { required: true },
        "soother_document_no": { required: true },
        "job_date": { required: true, application_date_required : true},
        "application_date": { required: true },
        "process_start_date": { required: true },
        "result_type_id": { required: true },
        "result_date": { required: true },
        "firm": { required: true },
      }
  };