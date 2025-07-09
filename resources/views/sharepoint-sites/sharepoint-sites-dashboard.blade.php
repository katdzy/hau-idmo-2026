<!-- This is the Sharepoint Sites dashboard -->
<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="w-full flex justify-center py-8">
            <div class="w-[95%] flex flex-col bg-white rounded-lg px-8 py-8 shadow-lg">
                <h1 class="text-[1.8rem] font-semibold mb-2">
                    SharePoint Sites
                </h1>
                <hr class="opacity-100 my-4">

                <!-- Tabs -->
                <div class="mb-6">
                    <ul class="flex border-b" id="tabs">
                        <li class="-mb-px mr-2">
                            <button class="tab-btn bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 font-semibold text-red-900 active" data-tab="tab-sharepoint">
                                ISO
                            </button>
                        </li>
                        <li class="-mb-px mr-2">
                            <button class="tab-btn bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 font-semibold text-red-900" data-tab="tab-forms">
                                Forms
                            </button>
                        </li>
                        <li class="-mb-px mr-2">
                            <button class="tab-btn bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 font-semibold text-red-900" data-tab="tab-policies">
                                Sample
                            </button>
                        </li>
                        <!-- Add more tabs as needed -->
                    </ul>
                </div>

                <!-- Tab Contents -->
                 <!-- ISO FILES -->
                <div id="tab-sharepoint" class="tab-content overflow-y-auto" style="max-height: 70vh;">
                    <div class="w-full flex flex-col gap-8">
                        <ul id="departments-list" class="space-y-4">

                            <!-- HAU-ISO 21001:2018 -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    HAU-ISO 21001:2018
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <a href="https://hauph.sharepoint.com/sites/HAU-ISO210012018/Shared%20Documents/Forms/AllItems.aspx"
                                            target="_blank" title="HAU-ISO 21001:2018"
                                            class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                            HAU-ISO 21001:2018
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- INTERNAL QUALITY AUDIT (IQA) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    INTERNAL QUALITY AUDIT (IQA)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <a href="https://hauph.sharepoint.com/sites/ISO-IQA21001/Shared%20Documents/Forms/AllItems.aspxs" 
                                            target="_blank" title="ISO-IQA 21001"
                                            class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                            ISO-IQA 21001
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- INTERNAL AUDIT TRAINING -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    INTERNAL AUDIT TRAINING
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <a href="https://hauph.sharepoint.com/sites/INTERNALAUDITTRAINING/Shared%20Documents/Forms/AllItems.aspx" 
                                            target="_blank" title="ISO-IQA 21001" 
                                            class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                            INTERNAL AUDIT TRAINING
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>

                            <!-- OFFICE OF THE PRESIDENT (OOP) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    OFFICE OF THE PRESIDENT (OOP)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP: OFFICE OF THE PRESIDENT
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-OOP/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-CKS: CENTER FOR KAPAMPANGAN STUDIES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CKS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-CKS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-ITS: INFORMATION TECHNOLOGY SYSTEMS SERVICES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-ITS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-ITS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-OIA: OFFICE OF INTERNATIONAL AFFAIRS
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-OIA/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-OIA
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-ITC: INSTITUTIONAL TESTING CENTER
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-ITC/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-ITC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-DPO: DATA PRIVACY  OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-oop-dpo/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-DPO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-TRO: TREASURY OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-oop-tro/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-TRO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OOP-UCO: UNIVERSITY CHAPLAIN OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-oop-uco/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OOP-UCO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- ACADEMIC AFFAIRS CLUSTER (AAC) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    ACADEMIC AFFAIRS CLUSTER (AAC)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC: ACADEMIC AFFAIRS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-LMS: LEARNING MANAGEMENT SYSTEM
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-CTL: CENTER FOR TEACHING & LEARNING
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-IRB: INSTITUTIONAL REVIEW BOARD
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-GSR: GRADUATE STUDIES & RESEARCH
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-aac-gsr/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-GSR
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-SAS: SCHOOL OF ARTS & SCIENCES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SAS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-SAS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-SBA: SCHOOL OF BUSINESS & ACCOUNTANCY
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SBA/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-SBA
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-SED: SCHOOL OF EDUCATION
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SED/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-SED
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-CJE: COLLEGE OF CRIMINAL JUSTICE EDUCATION & FORENSICS
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CJE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-CJE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-SEA: SCHOOL OF ENGINEERING & ARCHITECTURE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SEA/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-SEA
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-STM: SCHOOL OF HOSPITALITY & TOURISM MANAGEMENT
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SHTM/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-STM
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-SOC: SCHOOL OF COMPUTING
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SOC/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-SOC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-SNA: SCHOOL OF NURSING & ALLIED MEDICAL SCIENCES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-NAM/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    AAC-SNA: SCHOOL OF NURSING & ALLIED MEDICAL SCIENCES
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-BED: BASIC EDUCATION
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-BED/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-BED
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-LIB: LIBRARY DEPARTMENT
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-LIB/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-LIB
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AAC-URO: UNIVERSITY RESEARCH OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-URO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AAC-URO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- OFFICE OF INSTITUTIONAL EFFECTIVENESS (OIE) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    OFFICE OF INSTITUTIONAL EFFECTIVENESS (OIE)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OIE-QAO: QUALITY ASSURANCE OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-OIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OIE-IPR: INSTITUTIONAL RESEARCH, PLANNING & PUBLICATIONS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-OIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OIE-DMO: INSTITUTIONAL DATABASE MANAGEMENT OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-OIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            OIE-IDC: INSTITUTIONAL DOCUMENT CONTROLLER
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-OIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-OIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- INSTITUTE FOR CHRISTIAN FORMATION & SOCIAL INTEGRATION (CFS) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    INSTITUTE FOR CHRISTIAN FORMATION & SOCIAL INTEGRATION (CFS)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CFS-CES: OFFICE OF COMMUNITY EXTENSION SERVICES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CFS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CFS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CFS-CMO: CAMPUS MINISTRY OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CFS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CFS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CFS-CLE: CHRISTIAN LIVING EDUCATION
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CFS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CFS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CFS-CEP: CHARACTER EDUCATION PROGRAM DESK
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CFS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CFS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- HUMAN RESOURCE MANAGEMENT OFFICE (HRO) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    HUMAN RESOURCE MANAGEMENT OFFICE (HRO)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            HRO-HRM: RECRUITMENT & MAINTENANCE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-HRMO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-HRO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            HRO-HRD: HUMAN RESOURCE DEVELOPMENT
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-HRMO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-HRO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- FINANCE & RESOURCES MANAGEMENT SERVICES (FRM) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    FINANCE & RESOURCES MANAGEMENT SERVICES (FRM)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM: FINANCE & RESOURCES MANAGEMENT OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FIN/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM-GRT: GRANTS ACCOUNTANT
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FIN/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM-GRT
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM-ATO: ACCOUNTING OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM-ATO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM-PAO: PAYROLL OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FPO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM-PAO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM-ACC: ACCOUNTS & COLLECTION
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FAC/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM-AAC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM-ASE: ANCILLARY SERVICES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FAS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM-ASE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            FRM-ASA: ANCILLARY SERVICES - ACCOUNTING
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-FAS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-FRM-ASE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- RECORDS SYSTEMS & SERVICES (RSS) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    RECORDS SYSTEMS & SERVICES (RSS)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            RSS: RECORDS SYSTEMS & SERVICES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-RSS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-RSS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            RSS-ADO: ADMISSIONS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-RSS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-RSS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- STUDENT SERVICES & AFFAIRS (SSA) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    STUDENT SERVICES & AFFAIRS (SSA)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            SSA-SAO: STUDENT AFFAIRS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-SSA-SAO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            SSA-USO: UNIVERSITY SPORTS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SAO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-SSA-USO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            SSA-UGC: UNIVERSITY GUIDANCE CENTER
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-UGO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-SSA-UGC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            SSA-SGO: UNIVERSITY SCHOLARCHIPS & GRANTS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-SGO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-SSA-SGO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            SSA-CPO: CARREER & PLACEMENT OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CPO/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-SSA-CPO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            SSA-MDS: MEDICAL & DENTAL CLINIC
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-MEDDEN/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-SSA-MDS
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- EXTERNAL AFFAIRS CLUSTER (EAC) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    EXTERNAL AFFAIRS CLUSTER (EAC)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            EAC: EXTERNAL AFFAIRS CLUSTER
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-MCS/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-EAC
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            EAC-PAM: PERFORMING ARTS & EVENTS MANAGEMENT
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-PAM/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-EAC-PAM
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            EAC-ARO: ALUMNI RELATIONS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-eac-aro/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-EAC-ARO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            EAC-CRE: CREATIVES SERVICES
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-eac-pro/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-EAC-CRE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            EAC-PRO: PUBLIC RELATIONS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/iso-eac-pro/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-EAC-PRO
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- CAMPUS SERVICES & DEVELOPMENT OFFICE (CSD) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    CAMPUS SERVICES & DEVELOPMENT OFFICE (CSD)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-PUO: PURCHASING OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-CSO: CAMPUS SERVICES OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-PCO: PROPERTY CUSTODIAN SHIP
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-VLO: VENUES & LOGISTICS OFFICE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-MCM: MOTORPOOL/CAMPUS MAINTENANACE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-SEC: CAMPUS SECURITY
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            CSD-ECM: ENGINEERING CONSTRUCTION & MAINTENANCE
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-CSD/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-CSD
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- INSTITUTE FOR ACADEMIC INNOVATION & ENTREPRENEURSHIP (AIE) -->
                            <li>
                                <button type="button" class="w-full text-left font-bold text-red-900 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 transition department-btn">
                                    INSTITUTE FOR ACADEMIC INNOVATION & ENTREPRENEURSHIP (AIE)
                                </button>
                                <ul class="ml-6 mt-2 hidden office-list">
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AIE-SPL: SCHOOL OF PROFESSIONAL EDUCATION & LIFELONG LEARNING
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AIE-ETA: EXPANDED TERTIARY EDUCATION, EQUIVALENCY & ACCREDITATION
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <button type="button" class="w-full text-left font-semibold text-gray-800 px-3 py-1 bg-gray-50 rounded hover:bg-gray-100 transition office-btn">
                                            AIE-TBI: TECHNOLOGY BUSINESS INCUBATOR - KITTO
                                        </button>
                                        <ul class="ml-6 mt-1 hidden file-list">
                                            <li>
                                                <a href="https://hauph.sharepoint.com/sites/ISO-AIE/Shared%20Documents/Forms/AllItems.aspx" target="_blank" class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                                                    ISO-AIE
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>

                <div id="tab-forms" class="tab-content hidden">
                    <div class="w-full flex flex-col gap-8">
                        <h2 class="text-lg font-semibold text-red-900 mb-2">Forms</h2>
                        <ul class="space-y-2">
                            <li>
                                <a href="https://example.com/forms/leave-request.pdf" target="_blank" class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded hover:bg-green-200 transition">
                                    Sample Form
                                </a>
                            </li>
                            <li>
                                <a href="https://example.com/forms/overtime-request.pdf" target="_blank" class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded hover:bg-green-200 transition">
                                    Sample Form
                                </a>
                            </li>
                            <!-- Add more forms as needed -->
                        </ul>
                    </div>
                </div>
                <div id="tab-policies" class="tab-content hidden">
                    <div class="w-full flex flex-col gap-8">
                        <h2 class="text-lg font-semibold text-red-900 mb-2">Sample</h2>
                        <ul class="space-y-2">
                            <li>
                                <a href="https://example.com/policies/attendance-policy.pdf" target="_blank" class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded hover:bg-yellow-200 transition">
                                    Sample
                                </a>
                            </li>
                            <li>
                                <a href="https://example.com/policies/it-policy.pdf" target="_blank" class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded hover:bg-yellow-200 transition">
                                    Sample
                                </a>
                            </li>
                            <!-- Add more policies as needed -->
                        </ul>
                    </div>
                </div>
                <!-- Add more tab contents as needed -->
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Tabs logic
    document.addEventListener('DOMContentLoaded', function () {
        // Tab switching
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                // Remove active from all
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tc => tc.classList.add('hidden'));
                // Activate current
                btn.classList.add('active');
                document.getElementById(btn.getAttribute('data-tab')).classList.remove('hidden');
            });
        });

        // Dropdown logic for departments/offices/files
        document.querySelectorAll('.department-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const officeList = this.nextElementSibling;
                document.querySelectorAll('.office-list').forEach(list => {
                    if (list !== officeList) list.classList.add('hidden');
                });
                officeList.classList.toggle('hidden');
            });
        });
        document.querySelectorAll('.office-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const fileList = this.nextElementSibling;
                document.querySelectorAll('.file-list').forEach(list => {
                    if (list !== fileList) list.classList.add('hidden');
                });
                fileList.classList.toggle('hidden');
            });
        });
    });
</script>

<style>
    .tab-btn.active {
        background-color: #f3f4f6;
        border-bottom: 2px solid #70121D;
        color: #70121D;
    }
    .tab-content {
        animation: fadeIn 0.2s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .maroon {
        transition: 300ms;
    }
    .maroon:hover {
        background-color: #A84655;
    }
</style>
